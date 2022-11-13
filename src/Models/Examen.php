<?php

namespace Examai\Examai\Models;

use PDO;

class Examen extends Entity
{

    protected string $primaryKey = 'ID_EXAMEN';
    protected array $columns = [
        ['name' => 'ID_ENSEIGNANT', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_CLASSE', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_COUR', 'type' => 'integer', 'default' => null],
        ['name' => 'TYPE', 'type' => 'string', 'default' => null],
        ['name' => 'NATURE', 'type' => 'string', 'default' => null],
        ['name' => 'DUREE', 'type' => 'integer', 'default' => null],
        ['name' => 'NB_DE_VERSION', 'type' => 'integer', 'default' => null],
        ['name' => 'STATUT', 'type' => 'string', 'default' => null],
        ['name' => 'DATE_STRICTE', 'type' => 'boolean', 'default' => null],
        ['name' => 'QUESTIONS', 'type' => 'string', 'default' => null],
        ['name' => 'ORDRE_QUESTION', 'type' => 'boolean', 'default' => null],
        ['name' => 'ORDRE_CHOIX', 'type' => 'boolean', 'default' => null],
        ['name' => 'COMMENCE_A', 'type' => 'datetime', 'default' => null]
    ];


    public function questions()
    {
        $id_questions = json_decode($this->QUESTIONS);
        $questions = [];
        foreach ($id_questions as $id_question) {
            $question = Question::firstBy('ID_QUESTION', $id_question[0]);
            if ($question) {
                if ($question->ID_QUESTION_TYPE === Question_type::SWITCH) {
                    $options = json_decode($question->CHOIX);
                    foreach ($options as $option) {
                        $option['titre'] = trans($option['titre']);
                    }
                    $question->CHOIX = json_encode($options);
                }
                $questions[] = $question;
            }
        }

        return $questions;
    }


    public function passages()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        $class_name = explode('\\', Candidat_passage::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for list all data */
        $sql = "select * from " . strtolower($table_name) . " where $this->primaryKey = :$this->primaryKey";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([":$this->primaryKey" => $this->{$this->primaryKey}]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Candidat_passage::class);

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }
}