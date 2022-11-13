<?php

namespace Examai\Examai\Services;

use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Candidat_passage;
use Examai\Examai\Models\Classe;
use Examai\Examai\Models\Cour;
use Examai\Examai\Models\Examen;
use PDO;

abstract class ExamenService
{
    static function paginate_exams($start, $size, $column_sort, $sort_asc, $search)
    {

        if (in_array($column_sort, ['ID_EXAMEN', 'INFO', 'TYPE', 'NATURE', 'DUREE', 'STATUT', 'DATE_STRICTE', 'NB_DE_VERSION'])) {
            $column_sort = 'ID_EXAMEN';
        }

        $sort = ($sort_asc ? 'ASC' : 'DESC');

        $pdo = \Connection::instance();
        $view_examen_query = 'SELECT ID_EXAMEN, concat(classe.NOM_CLASSE, " - ", cour.NOM_COUR, "\n" , examen.COMMENCE_A) as INFO, TYPE, NATURE,DUREE,STATUT,DATE_STRICTE,NB_DE_VERSION FROM examen ';
        $view_examen_query .= 'left join cour on cour.ID_COUR = examen.ID_COUR ';
        $view_examen_query .= 'left join classe on classe.ID_CLASSE = examen.ID_CLASSE ';
        $view_examen_query .= 'where examen.ID_ENSEIGNANT = :ID_ENSEIGNANT ';

        $filter_query = "where INFO like :SEARCH or TYPE like :SEARCH or NATURE like :SEARCH or DUREE like :SEARCH or STATUT like :SEARCH or DATE_STRICTE like :SEARCH  or NB_DE_VERSION like :SEARCH ";
        $filter_query .= "ORDER BY $column_sort $sort ";
        $limit_query = "LIMIT :START, :LENGTH ";

        if (empty($search))
            $search = '';
        $search = '%' . $search . '%';

        $connecteduser_id = auth_user()->ID_ENSEIGNANT;
        $query = "select * from ( $view_examen_query ) view_examen $filter_query $limit_query";

        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll();

        $statement = $pdo->prepare("select count(*) from ( $view_examen_query ) view_examen ");
        $statement->bindValue(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->execute();
        $count_all_data = $statement->fetchColumn();

        $query = "select count(ID_EXAMEN) from ( $view_examen_query ) view_examen $filter_query";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);
        $statement->execute();
        $count_filtred_data = $statement->fetchColumn();

        return ["iTotalRecords" => $count_all_data, "iTotalDisplayRecords" => $count_filtred_data, "aaData" => $data];
    }


    static function calendar_exams()
    {
        $pdo = \Connection::instance();
        $view_examen_query = 'SELECT concat(classe.NOM_CLASSE, " - ", cour.NOM_COUR, "\n" , examen.COMMENCE_A) as title, examen.COMMENCE_A as start, DATE_ADD(examen.COMMENCE_A, INTERVAL DUREE MINUTE) as end FROM examen ';
        $view_examen_query .= 'left join cour on cour.ID_COUR = examen.ID_COUR ';
        $view_examen_query .= 'left join classe on classe.ID_CLASSE = examen.ID_CLASSE ';
        $view_examen_query .= 'where examen.ID_ENSEIGNANT = :ID_ENSEIGNANT ';
        $connecteduser_id = auth_user()->ID_ENSEIGNANT;
        $query = "select * from ( $view_examen_query ) view_examen ";

        $statement = $pdo->prepare($query);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->execute();
        $data = $statement->fetchAll();


        return $data;
    }


    static function create_exam($class_id, $cour_id, $type, $duration, $start_in, $status, $strict_date, $order_question, $order_choice, $version, $nature)
    {
        $cour = Cour::firstBy('ID_COUR', $cour_id);
        if (!$cour) {
            throw  new \Exception(trans('exam.course-not-found'));
        }

        $classe = Classe::firstBy('ID_CLASSE', $class_id);
        if (!$classe) {
            throw  new \Exception(trans('exam.class-not-found'));
        }

        $candidates = $classe->candidats();
        $exam = new Examen();
        $exam->ID_CLASSE = $class_id;
        $exam->ID_ENSEIGNANT = auth_user()->ID_ENSEIGNANT;
        $exam->TYPE = $type;
        $exam->DUREE = intval($duration);
        $exam->COMMENCE_A = $start_in;
        $exam->ID_COUR = $cour_id;
        $exam->STATUT = $status;
        $exam->DATE_STRICTE = $strict_date;
        $exam->ORDRE_QUESTION = $order_question;
        $exam->ORDRE_CHOIX = $order_choice;
        $exam->NB_DE_VERSION = $version;
        $exam->NATURE = $nature;
        $exam->QUESTIONS = json_encode($cour->twenty_question_ids());
        if ($exam->create()) {
            foreach ($candidates as $candidate) {
                $unique_id = \Connection::instance()->query('select uuid_short()')->fetchColumn(0);
                $passage = new Candidat_passage();
                $passage->ID_CANDIDAT = $candidate->ID_CANDIDAT;
                $passage->ID_EXAMEN = $exam->ID_EXAMEN;
                $passage->CODE = generateRandomString(6);
                $passage->NOTE = null;
                $passage->COMMENCE_A = null;
                $passage->TERMINE_A = null;
                $passage->LIEN = $unique_id;
                $passage->create();
            }
            return $exam;
        } else {
            \Connection::instance()->rollBack();
            throw  new \Exception(trans('exam.could-not-create-this-exam'));
        }
    }

    static function update_exam($id, $type, $duration, $start_in, $status, $strict_date, $order_question, $order_choice, $version, $nature)
    {
        $exam = Examen::firstBy('ID_EXAMEN', $id);
        if ($exam) {
            $exam->TYPE = $type;
            $exam->DUREE = $duration;
            $exam->COMMENCE_A = $start_in;
            $exam->STATUT = $status;
            $exam->DATE_STRICTE = $strict_date;
            $exam->ORDRE_QUESTION = $order_question;
            $exam->ORDRE_CHOIX = $order_choice;
            $exam->NB_DE_VERSION = $version;
            $exam->NATURE = $nature;
            if (!$exam->update())
                throw  new \Exception(trans('exam.could-not-update-this-exam'));
        }

        return $exam;
    }

    public static function delete_exam($id)
    {
        $exam = Examen::firstBy('ID_EXAMEN', $id);
        if ($exam) {
            $exam->delete();
            return true;
        }

        return false;
    }
}