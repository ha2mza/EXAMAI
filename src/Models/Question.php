<?php

namespace Examai\Examai\Models;

class Question extends Entity
{
    protected string $primaryKey = 'ID_QUESTION';
    protected array $columns = [
        ['name' => 'ID_COUR', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_QUESTION_TYPE', 'type' => 'integer', 'default' => null],
        ['name' => 'TITRE', 'type' => 'string', 'default' => null],
        ['name' => 'CHOIX', 'type' => 'string', 'default' => null],
        ['name' => 'POSITION', 'type' => 'integer', 'default' => null]
    ];
}