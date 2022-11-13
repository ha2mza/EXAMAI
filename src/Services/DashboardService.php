<?php

namespace Examai\Examai\Services;

class DashboardService
{

    public static function total_candidat()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql =
            "select count(*) from candidat c " .
            "inner join candidat_classe cc on cc.ID_CANDIDAT = c.ID_CANDIDAT " .
            "inner join classe cl on cl.ID_CLASSE = cc.ID_CLASSE " .
            "where cl.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_exam()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) from examen e where e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_classe()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) from classe e where e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_question()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql =
            "select count(*) from question q " .
            "inner join cour c on c.ID_COUR = q.ID_COUR " .
            "where c.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function last_exam_passed()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql =
            "select c.NOM_COUR from cour c , (select e.ID_COUR from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN  where cp.TERMINE_A is not null order by cp.TERMINE_A DESC limit 1) ex " .
            "where c.ID_COUR = ex. ID_COUR " .
            "and c.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_exam_passage()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN where e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_exam_passed()
    {

        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN where cp.TERMINE_A is not null and  e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_exam_not_passed()
    {

        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN where cp.COMMENCE_A is null and  e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function total_course()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) from cour c  where c.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT;
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchColumn();
    }

    public static function note_exam_overview()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select min(cp.NOTE) as x, max(cp.NOTE) as y from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN where cp.TERMINE_A is not null and  e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT . " group by e.ID_EXAMEN";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll(\PDO::FETCH_NUM);
    }

    public static function avg_note_by_classe()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select c.NOM_CLASSE, en.avg_note from classe c inner  join (select e.ID_CLASSE , avg(cp.NOTE) as avg_note from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN where cp.TERMINE_A is not null and  e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT . " group by e.ID_CLASSE) en on c.ID_CLASSE = en.ID_CLASSE ";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }

    public static function avg_note_by_course()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select c.NOM_COUR, en.avg_note from cour c inner  join (select e.ID_COUR , avg(cp.NOTE) as avg_note from candidat_passage cp inner join examen e on cp.ID_EXAMEN = e.ID_EXAMEN where cp.TERMINE_A is not null and  e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT . " group by e.ID_COUR) en on c.ID_COUR = en.ID_COUR ";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }

    public static function rating_question()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql = "select count(*) as total from reponse rep inner join examen e on rep.ID_EXAMEN = e.ID_EXAMEN where e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT . " and rep.correct = 1 ";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();
        $total_reponse_correct = $stmt->fetchColumn();

        /* a query statement for list all data */
        $sql = "select count(*) as total from reponse rep inner join examen e on rep.ID_EXAMEN = e.ID_EXAMEN where e.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT . " and rep.correct = 0 ";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();
        $total_reponse_incorrect = $stmt->fetchColumn();

        /* getting all data  via  fetchAll method */
        return [$total_reponse_incorrect , $total_reponse_correct];
    }

    public static function total_question_by_type()
    {/* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* a query statement for list all data */
        $sql =
            "select qt.ID_QUESTION_TYPE, c.NOM_COUR , count(*) as total from question q " .
            "inner join cour c on c.ID_COUR = q.ID_COUR " .
            "inner join question_type qt on qt.ID_QUESTION_TYPE = q.ID_QUESTION_TYPE " .
            "where c.ID_ENSEIGNANT =  " . auth_user()->ID_ENSEIGNANT . " " .
            "group by c.NOM_COUR , qt.ID_QUESTION_TYPE  order by qt.ID_QUESTION_TYPE asc,  c.NOM_COUR asc  ";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }
}