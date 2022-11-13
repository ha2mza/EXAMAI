<?php

namespace Examai\Examai\Services;

use Examai\Examai\Models\Cour;
use Examai\Examai\Models\Question;
use PDO;

abstract class CourService
{
    static function paginate_courses($start, $size, $column_sort, $sort_asc, $search)
    {

        if (in_array($column_sort, ['ID_COUR', 'NOM_COUR', 'NB_QST', 'LAST_DATE'])) {
            $column_sort = 'ID_COUR';
        }

        $sort = ($sort_asc ? 'ASC' : 'DESC');

        $pdo = \Connection::instance();
        $view_cour_query = 'SELECT cour.ID_COUR, NOM_COUR, count(question.ID_QUESTION) as NB_QST, max(examen.CREERA) as LAST_DATE FROM cour ';
        $view_cour_query .= 'left join question on question.ID_COUR = cour.ID_COUR ';
        $view_cour_query .= 'left join examen on examen.ID_COUR = cour.ID_COUR ';
        $view_cour_query .= 'where cour.ID_ENSEIGNANT = :ID_ENSEIGNANT ';
        $view_cour_query .= 'group by cour.ID_COUR, NOM_COUR ';

        $filter_query = "where ID_COUR like :SEARCH or NOM_COUR like :SEARCH or NB_QST like :SEARCH or LAST_DATE like :SEARCH ";
        $filter_query .= "ORDER BY $column_sort $sort ";
        $limit_query = "LIMIT :START, :LENGTH ";

        if (empty($search))
            $search = '';
        $search = '%' . $search . '%';

        $connecteduser_id = auth_user()->ID_ENSEIGNANT;
        $query = "select * from ( $view_cour_query ) view_cour $filter_query $limit_query";

        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll();

        $statement = $pdo->prepare("select count(*) from ( $view_cour_query ) view_cour ");
        $statement->bindValue(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->execute();
        $count_all_data = $statement->fetchColumn();

        $query = "select count(ID_COUR) from ( $view_cour_query ) view_cour $filter_query";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);
        $statement->execute();
        $count_filtred_data = $statement->fetchColumn();

        return ["iTotalRecords" => $count_all_data, "iTotalDisplayRecords" => $count_filtred_data, "aaData" => $data];
    }


    static function create_course($name)
    {
        $course = new Cour();
        $course->NOM_COUR = $name;
        $course->ID_ENSEIGNANT = auth_user()->ID_ENSEIGNANT;
        if ($course->create())
            return $course;
        else
            throw  new \Exception(trans('course.could-not-create-this-course'));
    }

    static function update_course($id, $name)
    {
        $course = Cour::firstBy('ID_COUR', $id);
        if ($course) {
            $course->NOM_COUR = $name;
            $course->ID_ENSEIGNANT = auth_user()->ID_ENSEIGNANT;
            if (!$course->update())
                throw  new \Exception(trans('course.could-not-update-this-course'));
        }

        return $course;
    }

    public static function delete_course($id)
    {
        $course = Cour::firstBy('ID_COUR', $id);
        if ($course) {
            $course->delete();
            return true;
        }

        return false;
    }


    static function create_question($id_cour, $question_type, $title, $options)
    {
        $question = new Question();
        $question->ID_COUR = $id_cour;
        $question->ID_QUESTION_TYPE = $question_type;
        $question->TITRE = $title;
        $question->CHOIX = json_encode($options, JSON_NUMERIC_CHECK);
        if ($question->create())
            return $question;
        else
            throw  new \Exception(trans('course.could-not-create-this-question'));
    }

    static function update_question($id, $id_cour, $question_type, $title, $options)
    {
        $question = Question::firstBy('ID_QUESTION', $id);
        if ($question) {
            $question->ID_COUR = $id_cour;
            $question->ID_QUESTION_TYPE = $question_type;
            $question->TITRE = $title;
            $question->CHOIX = json_encode($options, JSON_NUMERIC_CHECK);
            if (!$question->update())
                throw  new \Exception(trans('course.could-not-update-this-question'));
        }

        return $question;
    }

    public static function delete_question_not_in($id_cour, $ids)
    {
        $pdo = \Connection::instance();
        $param_names = [];
        $params = [];
        foreach ($ids as $key => $id) {
            $param_names[] = ':P' . $key;
            $params[':P' . $key] = $id;
        }
        $param_names = join(',', $param_names);
        $query = "delete from question where ID_COUR = :ID_COUR and ID_QUESTION not in ($param_names)";
        $params[':ID_COUR'] = $id_cour;
        $statement = $pdo->prepare($query);
        return $statement->execute($params);
    }
}