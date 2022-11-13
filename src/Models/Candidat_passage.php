<?php

namespace Examai\Examai\Models;

class Candidat_passage extends Entity
{

    protected string $primaryKey = 'id';
    protected array $columns = [
        ['name' => 'ID_CANDIDAT', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_EXAMEN', 'type' => 'integer', 'default' => null],
        ['name' => 'CODE', 'type' => 'string', 'default' => null],
        ['name' => 'ENVOYE_A', 'type' => 'datetime', 'default' => null],
        ['name' => 'NOTE', 'type' => 'float', 'default' => null],
        ['name' => 'COMMENCE_A', 'type' => 'datetime', 'default' => null],
        ['name' => 'TERMINE_A', 'type' => 'datetime', 'default' => null],
        ['name' => 'LIEN', 'type' => 'string', 'default' => null]
    ];

    /* list candidat par exam */
    public function getCandidatParExam()
    {

    }


    /* list exam par candidat */
    public function getExamParCandidat()
    {

    }


}