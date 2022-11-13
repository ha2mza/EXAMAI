<?php

namespace Examai\Examai\Controllers;

use Examai\Examai\Middleware\AuthMiddleware;
use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Examen;
use Examai\Examai\Services\CandidatService;
use Examai\Examai\Services\CourService;
use Examai\Examai\Services\DashboardService;
use Examai\Examai\Services\ExamenService;

class HomeController
{

    // check if user not connected
    // if user not connected redirect to login page
    // because all this method of controller required authentification
    public function __construct()
    {
        AuthMiddleware::check();
    }

    /* a dashboard page */
    function indexView()
    {
        global $total_candidat, $total_exam, $total_classe, $total_question, $last_exam_passed, $total_exam_passage, $total_exam_passed, $total_exam_not_passed, $total_course, $note_exam_overview, $avg_note_by_class, $avg_note_by_course, $total_question_by_type, $rating_question;
        $total_exam = DashboardService::total_exam();
        $total_classe = DashboardService::total_classe();
        $total_question = DashboardService::total_question();
        $last_exam_passed = DashboardService::last_exam_passed();
        $total_exam_passage = DashboardService::total_exam_passage();
        $total_exam_passed = DashboardService::total_exam_passed();
        $total_exam_not_passed = DashboardService::total_exam_not_passed();
        $total_candidat = DashboardService::total_candidat();
        $total_course = DashboardService::total_course();
        $note_exam_overview = DashboardService::note_exam_overview();
        $avg_note_by_class = DashboardService::avg_note_by_classe();
        $avg_note_by_course = DashboardService::avg_note_by_course();
        $rating_question = DashboardService::rating_question();
        $total_question_by_type = DashboardService::total_question_by_type();
        $labels = [];
        $series = [['name' => 'Une Seul Choix', 'data' => []], ['name' => 'Multi Choix', 'data' => []], ['name' => 'Switch', 'data' => []]];
        foreach ($total_question_by_type as $item) {
            if (!in_array($item['NOM_COUR'], $labels))
                $labels[] = $item['NOM_COUR'];
        }
        foreach ($labels as $label) {

            foreach ($total_question_by_type as $item) {
                if ($item['NOM_COUR'] === $label) {
                    $series[$item['ID_QUESTION_TYPE'] - 1]['data'][] = $item['total'];
                }
            }
        }
        $total_question_by_type = [$labels, $series];
        require_once ROOT . '/src/Views/home/index.php';

    }

    public function calendarView()
    {
        global $events;
        $events = ExamenService::calendar_exams();
        require_once ROOT . '/src/Views/calendar/index.php';
    }
}