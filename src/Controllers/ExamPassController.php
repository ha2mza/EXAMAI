<?php

namespace Examai\Examai\Controllers;

use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Candidat_passage;
use Examai\Examai\Models\Candidat_repondre;
use Examai\Examai\Models\Cour;
use Examai\Examai\Models\Enseignant;
use Examai\Examai\Models\Examen;
use Examai\Examai\Models\Question;
use Examai\Examai\Models\Question_type;
use Postal\Client;
use Postal\SendMessage;

class ExamPassController
{

    public function indexView()
    {
        $id = request_input('LINK');
        $code = request_input('CODE');
        $exam_candidat = Candidat_passage::firstBy('LIEN', $id);
        if ($exam_candidat) {
            $exam = Examen::firstBy('ID_EXAMEN', $exam_candidat->ID_EXAMEN);
            $cour = Cour::firstBy('ID_COUR', $exam->ID_COUR);
            $candidat = Candidat::firstBy('ID_CANDIDAT', $exam_candidat->ID_CANDIDAT);
            $GLOBALS['id'] = $id;
            $GLOBALS['code'] = $code;
            $GLOBALS['exam'] = $exam;
            $GLOBALS['cour'] = $cour;
            $GLOBALS['candidat'] = $candidat;
            if ($exam->STATUT === 'closed') {
                require_once ROOT . '/src/Views/exam/passage-closed.php';
            } else if ($exam->NATURE === 'offline') {
                require_once ROOT . '/src/Views/exam/passage-offline.php';
            } else if (strtotime($exam->COMMENCE_A) > time()) {
                require_once ROOT . '/src/Views/exam/passage-loading.php';
            } else if ($exam->DATE_STRICTE && (strtotime($exam->COMMENCE_A) + $exam->DUREE * 60 - time()) < 0) {
                require_once ROOT . '/src/Views/exam/passage-locked.php';
            } else if (!$exam->DATE_STRICTE && $exam_candidat->COMMENCE_A && (strtotime($exam_candidat->COMMENCE_A) + $exam->DUREE * 60 - time()) < 0) {
                require_once ROOT . '/src/Views/exam/passage-locked.php';
            } else if ($exam_candidat->TERMINE_A) {
                require_once ROOT . '/src/Views/exam/passage-score.php';
            } else {
                if (empty($code) || $code !== $exam_candidat->CODE) {
                    require_once ROOT . '/src/Views/exam/passage-auth.php';
                } else {
                    if (!$exam_candidat->COMMENCE_A) {
                        $exam_candidat->COMMENCE_A = date('y-m-d H:i:s');
                        $exam_candidat->update();
                    }
                    $GLOBALS['exam_candidat'] = $exam_candidat;
                    $ids_question = json_decode($exam->QUESTIONS);
                    $questions = [];
                    foreach ($ids_question as $id_questions) {
                        $questions[] = Question::firstBy('ID_QUESTION', $id_questions[0]);
                    }
                    $GLOBALS['questions'] = $questions;
                    require_once ROOT . '/src/Views/exam/passage.php';
                }
            }
        } else {
            require_once ROOT . '/src/Views/exam/passage-404.php';
        }
    }

    public function CloseExam()
    {
        $id = request_input('LIEN');
        $code = request_input('CODE');
        $exam_candidat = Candidat_passage::firstBy('LIEN', $id);
        if ($exam_candidat) {
            $exam = Examen::firstBy('ID_EXAMEN', $exam_candidat->ID_EXAMEN);
            $prof = Enseignant::firstBy('ID_ENSEIGNANT', $exam->ID_ENSEIGNANT);
            $cour = Cour::firstBy('ID_COUR', $exam->ID_COUR);
            $total_questions = count($exam->questions());

            if (empty($code) || $code !== $exam_candidat->CODE)
                notfound_request(trans('exam-candidat.not-authorized-to-close-this-exam'));

            if (!$exam_candidat->COMMENCE_A)
                notfound_request(trans('exam-candidat.not-started-for-closed'));

            if ($exam_candidat->TERMINE_A)
                notfound_request(trans('exam-candidat.already-closed'));

            $answers = request_input('answers');
            $correct_reponse = 0;
            $htmlcontent = '<h1 style="color: #031a61">Exam<span style="color: #727cf5">AI</span></h1> <p>Ce sont les réponses auxquelles vous avez répondu sur notre plateforme</p>';
            $index = 0;
            foreach ($answers as $key => $answer) {
                $question = Question::firstBy('ID_QUESTION', $key);
                $htmlcontent .= '<p><b>' . ($index + 1) . '. ' . $question->TITRE . '</b></p>';
                if ($question) {
                    $options = json_decode($question->CHOIX);
                    $responses = [];
                    foreach ($options as $option) {
                        if (in_array($option->index, (array)$answer))
                            $htmlcontent .= " <div style='padding: 0 15px;'>  <b> $option->titre</b></div>";
                        else
                            $htmlcontent .= " <div  style='padding: 0 15px;'> <p> $option->titre</p></div>";
                        if ($option->correct)
                            $responses[] = $option->index;
                    }

                    if ((array)$answer == $responses) {
                        $correct_reponse++;
                    }

                    $candidat_repondre = new Candidat_repondre();
                    $candidat_repondre->ID_CANDIDAT = $exam_candidat->ID_CANDIDAT;
                    $candidat_repondre->ID_EXAMEN = $exam_candidat->ID_EXAMEN;
                    $candidat_repondre->ID_QUESTION = $question->ID_QUESTION;
                    $candidat_repondre->REPONDRE = json_encode((array)$answer);
                    $candidat_repondre->create();
                }
                $index++;
            }

            $exam_candidat->NOTE = $correct_reponse * 20 / $total_questions;
            $exam_candidat->TERMINE_A = date('y-m-d H:i:s');
            $exam_candidat->update();
            // Create a new Postal client using the server key you generate in the web interface
            $client = new Client('https://postal.codmanaging.com', 'xpGYC3iFoQuOZYnNBRQVMzzp');

            $candidat = Candidat::firstBy('ID_CANDIDAT', $exam_candidat->ID_CANDIDAT);

            $message = new SendMessage($client);

            $message->to($candidat->EMAIL);
            $message->cc('hamz.moukhlis@gmail.com');
            $message->from($prof->NOM_ENSEIGNANT . ' ' . $prof->PRENOM_ENSEIGNANT . ' ExamAI <support@codmanaging.com>');
            $message->subject('Sommaire Passage Exam ' . $cour->NOM_COUR . ' - ' . $exam->COMMENCE_A);
            $message->htmlBody($htmlcontent);
            $result = $message->send();

            ok_request(['note' => $correct_reponse]);

        }

        notfound_request(trans('exam-candidat.not-found'));
    }

}