<?php

namespace Examai\Examai\Controllers;

use Examai\Examai\Middleware\AuthMiddleware;
use Examai\Examai\Models\Cour;
use Examai\Examai\Models\Question_type;
use Examai\Examai\Services\CourService;

class CourseController
{

    // check if user not connected
    // if user not connected redirect to login page
    // because all this method of controller required authentification
    public function __construct()
    {
        AuthMiddleware::check();
    }

    /* get method display list of courses with pagination */
    public function indexView()
    {
        require_once ROOT . '/src/Views/course/index.php';
    }

    /* all courses with pagination this request called via datatable.js */
    /* list of courses is given by connected user  */
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
        ok_request(CourService::paginate_courses($row, $rowperpage, $columnName, $columnSortOrder, $searchValue));
    }


    /* create course for a connected user */
    public function store()
    {
        $name = request_data('NOM_COUR');
        if (!empty($name)) {
            try {
                $course = CourService::create_course($name);
                ok_request(['message' => trans('course.create-course-success'), 'data' => $course]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('course.name-field-required'));

    }

    /* update course for a connected user */
    public function update()
    {

        $name = request_data('NOM_COUR');
        $id = request_data('ID_COUR');
        if (!empty($id) && !empty($name)) {
            try {
                $course = CourService::update_course($id, $name);
                ok_request(['message' => trans('course.update-course-success'), 'data' => $course]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('course.all-field-required'));
    }

    /* delete course for a connected user */
    public function delete()
    {
        $id = request_data('ID_COUR');
        if (!empty($id)) {
            try {
                $course = Cour::firstBy('ID_COUR', $id);
                if ($course) {
                    $course->delete();
                    ok_request(['message' => trans('course.delete-course-success')]);
                } else
                    notfound_request(trans('course.course-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('course.all-field-required'));
    }

    /* the principe of this function is  only return information that necessary for editing course */
    public function edit()
    {
        $id = request_data('ID_COUR');
        if (!empty($id)) {
            try {
                $course = Cour::firstBy('ID_COUR', $id);
                if ($course) {
                    ok_request(['course' => $course]);
                } else
                    notfound_request(trans('course.course-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }
        bad_request(trans('course.all-field-required'));
    }

    /* the principe of this function is  only return questions + information that necessary for editing, deleting or creating question in existing course */
    public function questions()
    {
        $id = request_input('ID_COUR');
        if (!empty($id)) {
            try {
                $course = Cour::firstBy('ID_COUR', $id);
                if ($course) {
                    $questions = $course->questions();
                    foreach ($questions as $question) {
                        $question->options = json_decode($question->CHOIX);
                        $question->title = $question->TITRE;
                        $question->question_type_id = $question->ID_QUESTION_TYPE;
                    }
                    ok_request(['course' => $course, 'questions' => $questions, 'question_types' => Question_type::select2format()]);
                } else
                    notfound_request(trans('course.course-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }
        notfound_request(trans('course.course-not-found'));
    }

    /* this method for deleting , creating, updating questions in existing course */
    public function change_questions()
    {
        $id = request_input('ID_COUR');
        if (!empty($id)) {
            try {
                // check if this course id passing via form data exists in table courses or not
                $course = Cour::firstBy('ID_COUR', $id);
                if ($course) {
                    // reading all questions
                    $questions = request_input('questions');
                    $ids_questions = [];
                    // read question by question, loop mécanisme ,
                    // watch this video for learning how loop work: https://www.youtube.com/watch?v=nGLvamg0efM
                    foreach ($questions as $question) {
                        $oquestion = null;
                        // this loop for converting "true"  to true , and "false" to false
                        // converting string to boolean
                        foreach ($question['options'] as $key => $option) {
                            $question['options'][$key]['correct'] = $option['correct'] === "true";
                        }
                        // if not existing id question, so we need creating question in this part :)
                        if (!isset($question['ID_QUESTION']))
                            $oquestion = CourService::create_question($id, $question['question_type_id'], $question['title'], $question['options']);

                        // if existing id question, so we need upadting question in this part :)
                        if (isset($question['ID_QUESTION']))
                            $oquestion = CourService::update_question($question['ID_QUESTION'], $id, $question['question_type_id'], $question['title'], $question['options']);
                        // if question exists we need import id to array called ids_question, why? will response that in the next instruction
                        if ($oquestion !== null)
                            $ids_questions[] = $oquestion->ID_QUESTION;
                    }
                    // so the response of why is here  we need delete all question is not in array called ids_questions
                    // why we need delete because the parameter $questions it's given by teacher and teacher give me all questions need so i have id  of all questions he needs, but i don't have the question that he not need, so for that we do delete question that not has his id
                    CourService::delete_question_not_in($id, $ids_questions);

                    ok_request(['message' => trans('course.change-question-course-success'), 'q' => $questions]);
                } else
                    notfound_request(trans('course.course-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }
        notfound_request(trans('course.course-not-found'));

    }
}