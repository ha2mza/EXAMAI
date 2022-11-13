<?php

namespace Examai\Examai\Models;

class Candidat_repondre extends Entity
{

    protected string $primaryKey = 'id';
    protected array $columns = [
        ['name' => 'ID_CANDIDAT', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_QUESTION', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_EXAMEN', 'type' => 'integer', 'default' => null],
        ['name' => 'REPONDRE', 'type' => 'string', 'default' => null]
    ];

    /* list les reponse par candidat  et exam */

    public function getRepondreParCandidatDansExam($id_candidat, $id_exam){

    }

}