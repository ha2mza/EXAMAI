<?php

namespace Examai\Examai\Controllers;

use Dompdf\Dompdf;
use Examai\Examai\Middleware\AuthMiddleware;
use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Classe;
use Examai\Examai\Models\Cour;
use Examai\Examai\Models\Enseignant;
use Examai\Examai\Models\Examen;
use Examai\Examai\Models\Question_type;
use Examai\Examai\Services\ExamenService;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Style\Paper;
use Postal\Client;
use Postal\SendMessage;

class ExamController
{

    // check if user not connected
    // if user not connected redirect to login page
    // because all this method of controller required authentification
    public function __construct()
    {
        AuthMiddleware::check();
    }

    /* get method display list of exams with pagination */
    public function indexView()
    {
        require_once ROOT . '/src/Views/exam/index.php';
    }

    /* all exams with pagination this request called via datatable.js */
    /* list of exams is given by connected user  */
    public function index()
    {
        ## Read value
        ## $draw = request_data('draw');
        $row = request_data('start');
        $rowperpage = request_data('length');
        $columnIndex = request_input('order.0.column');
        $columnName = request_input("columns.$columnIndex.data");
        $columnSortOrder = strtolower(request_input("order.0.dir")) === "asc";
        $searchValue = request_input("search.value");
        ok_request(ExamenService::paginate_exams($row, $rowperpage, $columnName, $columnSortOrder, $searchValue));
    }

    /* get necessary data for creating exam */
    public function create()
    {
        try {
            $classes = Classe::select2format(auth_user()->ID_ENSEIGNANT);
            $courses = Cour::select2format(auth_user()->ID_ENSEIGNANT);
            ok_request(['classes' => $classes, 'courses' => $courses]);
        } catch (\Exception $e) {
            bad_request($e->getMessage());
        }
    }

    /* create exam for a connected user */
    public function store()
    {
        $class_ids = request_data('id_classes');
        $cour_id = request_data('cour_id');
        $type = request_data('type');
        $duration = request_data('duration');
        $start_in = request_data('start-in');
        $status = request_data('status');
        $order_question = request_data('order-question') === 'on';
        $order_choice = request_data('order-choice') === 'on';
        $version = request_data('number-version');
        $nature = request_data('nature');
        $strict_date = request_data('strict-date') === 'on';
        if (!empty($class_ids)) {
            try {
                foreach ($class_ids as $class_id) {
                    $exam = ExamenService::create_exam($class_id, $cour_id, $type, $duration, $start_in, $status, $strict_date, $order_question, $order_choice, $version, $nature);
                }
                ok_request(['message' => trans('exam.create-exam-success'), 'data' => $exam]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('exam.field-required'));

    }

    /* update exam for a connected user */
    public function update()
    {

        $id = request_data('ID_EXAMEN');
        $type = request_data('type');
        $duration = request_data('duration');
        $start_in = request_data('start-in');
        $status = request_data('status');
        $order_question = request_data('order-question') === 'on';
        $order_choice = request_data('order-choice') === 'on';
        $version = request_data('number-version');
        $nature = request_data('nature');
        $strict_date = request_data('strict-date') === 'on';
        if (!empty($id)) {
            try {
                $exam = ExamenService::update_exam($id, $type, $duration, $start_in, $status, $strict_date, $order_question, $order_choice, $version, $nature);
                ok_request(['message' => trans('exam.update-exam-success'), 'data' => $exam]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('exam.all-field-required'));
    }

    /* delete exam for a connected user */
    public function delete()
    {
        $id = request_data('ID_EXAMEN');
        if (!empty($id)) {
            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                if ($exam) {
                    $exam->delete();
                    ok_request(['message' => trans('exam.delete-exam-success')]);
                } else
                    notfound_request(trans('exam.exam-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('exam.all-field-required'));
    }

    /* the principe of this function is  only return information that necessary for editing exam */
    public function edit()
    {
        $id = request_data('ID_EXAMEN');
        if (!empty($id)) {
            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                if ($exam) {
                    ok_request(['exam' => $exam]);
                } else
                    notfound_request(trans('exam.exam-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }
        bad_request(trans('exam.all-field-required'));
    }

    public function questions()
    {
        $id = request_input('ID_EXAMEN');
        if (!empty($id)) {
            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                if ($exam) {
                    ok_request(['exam' => $exam, 'questions' => $exam->questions()]);
                } else
                    notfound_request(trans('exam.exam-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
        }
        notfound_request(trans('exam.exam-not-found'));
    }

    private function render($path)
    {
        ob_start();
        include($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }


    public function export_document()
    {
        $id = request_input('ID_EXAMEN');
        $type_document = request_input('type');
        if (!empty($id)) {

            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                if ($exam) {
                    $GLOBALS['exam'] = $exam;
                    $GLOBALS['cour'] = Cour::firstBy('ID_COUR', $exam->ID_COUR);
                    $GLOBALS['questions'] = $exam->questions();
                    switch (strtolower($type_document)) {
                        case 'pdf':
                            $dompdf = new Dompdf();
                            $dompdf->loadHtml($this->render(ROOT . '/src/Views/exam/print.php'));
                            $dompdf->render();
                            $file_to_save = 'file.pdf';
                            file_put_contents($file_to_save, $dompdf->output());
                            header('Content-type: application/octet-stream');
                            header('Content-Disposition: inline; filename="exam_' . $GLOBALS['cour']->NOM_COUR . '.pdf"');
                            header('Content-Transfer-Encoding: binary');
                            header('Content-Length: ' . filesize($file_to_save));
                            header('Connection: Keep-Alive');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');
                            header('Accept-Ranges: bytes');
                            readfile($file_to_save);
                            unlink($file_to_save);
                            break;
                        case  'word':

                            $phpWord = new PhpWord();

                            $paper = new Paper();
                            $paper->setSize('A4');  // or 'Legal', 'A4' ...

                            $section = $phpWord->addSection([
                                'pageSizeW' => $paper->getWidth(),
                                'pageSizeH' => $paper->getHeight(),
                            ]);

                            $header = array('size' => 16, 'bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
                            $section->addText($GLOBALS['cour']->NOM_COUR, $header);
                            $section->addTextBreak(1);
                            $fancyTableStyle = [
                                'borderSize' => 6,
                                'borderColor' => 'EEEEEE',
                                'cellMargin' => 80,
                                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
                                'layout' => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED,
                                'width' => 3508
                            ];
                            $table = $section->addTable($fancyTableStyle);
                            $table->addRow();
                            $table->addCell(1754 * 3)->addText('Nom:');
                            $table->addCell(1754 * 3)->addText('Prenom:');
                            $table->addRow();
                            $table->addCell(1754 * 3)->addText("\n\n\n");
                            $table->addCell(1754 * 3)->addText("\n\n\n");

                            $section->addTextBreak(2);
                            foreach ($GLOBALS['questions'] as $index => $question) {
                                $section->addText(($index + 1) . '. ' . $question->TITRE, array('size' => 11, 'bold' => true));
                                $section->addTextBreak(1);

                                $options = json_decode($question->CHOIX);
                                foreach ($options as $option) {
                                    $section->addText($option->titre . "\t\t\r [  ]", array('size' => 10, 'bold' => false));
                                    $section->addTextBreak(1);

                                }
                            }


                            \PhpOffice\PhpWord\Settings::setCompatibility(false);
                            header('Content-type: application/octet-stream');
                            header('Content-Disposition: inline; filename="exam_' . $GLOBALS['cour']->NOM_COUR . date("h:i:s") . '.docx"');
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');
                            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                            $objWriter->save('php://output');
                            exit;
                        case  'html':
                            header('Content-type: application/octet-stream');
                            header('Content-Disposition: inline; filename="exam_' . $GLOBALS['cour']->NOM_COUR . '.html"');
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');

                            echo $this->render(ROOT . '/src/Views/exam/print.php');
                            break;
                        default:
                            notfound_request(trans('exam.document-type-not-supported'));
                    }
                    exit;
                }
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
        }
        notfound_request(trans('exam.exam-not-found'));
    }


    function sendExam()
    {

        $id = request_input('ID_EXAMEN');
        if (!empty($id)) {
            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                $prof = Enseignant::firstBy('ID_ENSEIGNANT', $exam->ID_ENSEIGNANT);
                $passages = $exam->passages();
                $cour = Cour::firstBy('ID_COUR', $exam->ID_COUR);

                // Create a new Postal client using the server key you generate in the web interface
                $client = new Client('https://postal.codmanaging.com', 'xpGYC3iFoQuOZYnNBRQVMzzp');

                foreach ($passages as $passage) {
                    $candidat = Candidat::firstBy('ID_CANDIDAT', $passage->ID_CANDIDAT);

                    $message = new SendMessage($client);

                    $message->to($candidat->EMAIL);
                    $message->cc('hamz.moukhlis@gmail.com');
                    $message->from($prof->NOM_ENSEIGNANT . ' ' . $prof->PRENOM_ENSEIGNANT . ' ExamAI <support@codmanaging.com>');
                    $message->subject('Exam ' . $cour->NOM_COUR . ' - ' . $exam->COMMENCE_A);
                    $message->htmlBody('<h1 style="color: #031a61">Exam<span style="color: #727cf5">AI</span></h1><p> Bonjour <b>' . $candidat->NOM . ' ' . $candidat->PRENOM . '</b>, Vous avez un examen sur le cour <b>' . $cour->NOM_COUR . '</b> a la date <b style="color: red;">' . $exam->COMMENCE_A . '</b> pour ouvrir l\'exam il faut saisir la clé suivant <b>' . $passage->CODE . '</b> sur le lien <a href="' . (DOMAIN . '/passage/?LINK=' . $passage->LIEN) . '">Click Ici</a></p><p>Merci pour votre attention!</p> Cordialement');
                    $result = $message->send();

                    $passage->ENVOYE_A = date('y-m-d H:i:s');
                    $passage->update();

                }
                ok_request(['message' => trans('exam.message-send-success')]);

            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
        }
        notfound_request(trans('exam.exam-not-found'));
    }

    public function viewMarks()
    {
        $id = request_input('ID_EXAMEN');
        if (!empty($id)) {
            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                $passages = $exam->passages();

                foreach ($passages as $passage) {
                    $candidat = Candidat::firstBy('ID_CANDIDAT', $passage->ID_CANDIDAT);
                    $passage->candidat = $candidat;
                }

                ok_request(['exam' => $exam, 'marks' => $passages]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
        }
        notfound_request(trans('exam.exam-not-found'));
    }

    public function export_mark()
    {
        $id = request_input('ID_EXAMEN');
        $type_document = request_input('type');
        if (!empty($id)) {

            try {
                $exam = Examen::firstBy('ID_EXAMEN', $id);
                if ($exam) {
                    $passages = $exam->passages();
                    foreach ($passages as $passage) {
                        $candidat = Candidat::firstBy('ID_CANDIDAT', $passage->ID_CANDIDAT);
                        $passage->candidat = $candidat;
                    }

                    $GLOBALS['exam'] = $exam;
                    $GLOBALS['cour'] = Cour::firstBy('ID_COUR', $exam->ID_COUR);
                    $GLOBALS['marks'] = $passages;
                    switch (strtolower($type_document)) {
                        case 'pdf':
                            $dompdf = new Dompdf();
                            $dompdf->loadHtml($this->render(ROOT . '/src/Views/exam/print_mark.php'));
                            $dompdf->render();
                            $file_to_save = 'file.pdf';
                            file_put_contents($file_to_save, $dompdf->output());
                            header('Content-type: application/octet-stream');
                            header('Content-Disposition: inline; filename="mark_exam_' . $GLOBALS['cour']->NOM_COUR . '.pdf"');
                            header('Content-Transfer-Encoding: binary');
                            header('Content-Length: ' . filesize($file_to_save));
                            header('Connection: Keep-Alive');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');
                            header('Accept-Ranges: bytes');
                            readfile($file_to_save);
                            unlink($file_to_save);
                            break;
                        case  'excel':
                            $file_to_save = 'file.csv';

                            $fp = fopen('file.csv', 'w');


                            $passages = $exam->passages();
                            fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
                            fputcsv($fp, [trans('candidat.last-name'), trans('candidat.first-name'), trans('candidat.email'), trans('exam.mark')]);
                            foreach ($passages as $passage) {
                                $candidat = Candidat::firstBy('ID_CANDIDAT', $passage->ID_CANDIDAT);
                                fputcsv($fp, [$candidat->NOM, $candidat->PRENOM, $candidat->EMAIL, $passage->NOTE ?? '-----']);
                            }

                            fclose($fp);

                            header('Content-type: application/octet-stream; charset=utf-8');
                            header('Content-Disposition: inline; filename="mark_exam_' . $GLOBALS['cour']->NOM_COUR . '.csv"');
                            header('Content-Transfer-Encoding: binary');
                            header('Content-Length: ' . filesize($file_to_save));
                            header('Connection: Keep-Alive');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');
                            header('Accept-Ranges: bytes');

                            readfile($file_to_save);


                            unlink($file_to_save);

                            break;
                        default:
                            notfound_request(trans('exam.document-type-not-supported'));
                    }
                    exit;
                }
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
        }
        notfound_request(trans('exam.exam-not-found'));
    }
}