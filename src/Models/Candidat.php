<?php

namespace Examai\Examai\Models;

class Candidat extends Entity
{
    protected string $primaryKey = 'ID_CANDIDAT';
    protected array $columns = [
        ['name' => 'NOM', 'type' => 'string', 'default' => null],
        ['name' => 'PRENOM', 'type' => 'string', 'default' => null],
        ['name' => 'MOT_DE_PASSE', 'type' => 'string', 'default' => null],
        ['name' => 'EMAIL', 'type' => 'string', 'default' => null]
    ];


}