<?php

namespace Examai\Examai\Models;

use PDO;

class Enseignant extends Entity
{

    protected string $primaryKey = 'ID_ENSEIGNANT';
    protected array $columns = [
        ['name' => 'NOM_ENSEIGNANT', 'type' => 'string', 'default' => null],
        ['name' => 'PRENOM_ENSEIGNANT', 'type' => 'string', 'default' => null],
        ['name' => 'MOT_DE_PASSE', 'type' => 'string', 'default' => null],
        ['name' => 'EMAIL', 'type' => 'string', 'default' => null]
    ];


    /* get Enseignant by email */

    static function getEnseignantByEmail($email)
    {
        $pdo = \Connection::instance();
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];
        $sql = "select * from " . strtolower($table_name) . " where EMAIL= :EMAIL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':EMAIL' => $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch();
    }

    /* get Enseignant by id */
    static function getEnseignantById($id)
    {
        $pdo = \Connection::instance();
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];
        $sql = "select * from " . strtolower($table_name) . " where ID_ENSEIGNANT= :ID_ENSEIGNANT";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ID_ENSEIGNANT' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch();
    }

}