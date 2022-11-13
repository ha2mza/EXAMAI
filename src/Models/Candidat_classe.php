<?php

namespace Examai\Examai\Models;
use PDO;

class Candidat_classe extends Entity
{
    protected string $primaryKey = 'id';
    protected array $columns = [
        ['name' => 'ID_CANDIDAT', 'type' => 'integer', 'default' => null],
        ['name' => 'ID_CLASSE', 'type' => 'integer', 'default' => null]
    ];

    /*  list des candidat par classe*/

    public static function getcandidatparClasse($id_class)
    {
    }

    /*  list des classe par candidate*/

    public static function getClasseParCandidate($id_candidat)
    {

    }

    public static function find($id_candidat, $id_classe)
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* a query statement for list all data */
        $sql = "select * from candidat_classe where ID_CANDIDAT=:ID_CANDIDAT and ID_CLASSE=:ID_CLASSE limit 1";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([":ID_CANDIDAT" => $id_candidat, ":ID_CLASSE" => $id_classe]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);

        /* getting all data  via  fetchAll method */
        return $stmt->fetch();
    }

}