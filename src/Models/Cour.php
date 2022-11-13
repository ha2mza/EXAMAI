<?php

namespace Examai\Examai\Models;

use PDO;

class Cour extends Entity
{

    protected string $primaryKey = 'ID_COUR';
    protected array $columns = [
        ['name' => 'ID_ENSEIGNANT', 'type' => 'integer', 'default' => null],
        ['name' => 'NOM_COUR', 'type' => 'string', 'default' => null]
    ];


    /* this method return question for current object (course) */
    /* more detail:  whe know this method is a no static method so for call this method i need create instance, when create instance the value of id  should be existed */
    public function questions()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        $class_name = explode('\\', Question::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for list all data */
        $sql = "select * from " . strtolower($table_name) . " where $this->primaryKey = :$this->primaryKey";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([":$this->primaryKey" => $this->{$this->primaryKey}]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Question::class);

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }

    /* this method return id of twenty question or less for current object (course) */
    public function twenty_question_ids()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        $class_name = explode('\\', Question::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for list max twenty data */
        $sql = "select ID_QUESTION from " . strtolower($table_name) . " where $this->primaryKey = :$this->primaryKey ORDER BY RAND() LIMIT 20";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([":$this->primaryKey" => $this->{$this->primaryKey}]);
        $stmt->setFetchMode(PDO::FETCH_NUM);

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }

    /* get all courses by teacher pass in parameter with a specific format adapting with javascript for library select2 */
    public static function select2format($id)
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();
        /* generate table_name from class automatically */
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];
        /* a query statement for list all data */
        $sql = "select ID_COUR as id , NOM_COUR as text from " . strtolower($table_name) . " where ID_ENSEIGNANT= :ID_ENSEIGNANT";
        $stmt = $pdo->prepare($sql);
        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([':ID_ENSEIGNANT' => $id]);
        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }

}