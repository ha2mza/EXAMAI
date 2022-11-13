<?php

namespace Examai\Examai\Models;

use PDO;

class Classe extends Entity
{

    protected string $primaryKey = 'ID_CLASSE';
    protected array $columns = [
        ['name' => 'ID_ENSEIGNANT', 'type' => 'integer', 'default' => null],
        ['name' => 'NOM_CLASSE', 'type' => 'string', 'default' => null],
        ['name' => 'ANNEE', 'type' => 'integer', 'default' => null],
        ['name' => 'CODE', 'type' => 'string', 'default' => null]
    ];

    /* get classe by code */
    public static function getClasseByCode($code)
    {
        $pdo = \Connection::instance();
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];
        $sql = "select * from " . strtolower($table_name) . " where CODE= :CODE";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':CODE' => $code]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch();
    }

    /* get all classes by teacher pass in parameter  with a specific format adapting with javascript for library select2 */
    public static function select2format($id)
    {

        $pdo = \Connection::instance();
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];
        $sql = "select ID_CLASSE as id , concat(NOM_CLASSE, ',' , ANNEE ) as text from " . strtolower($table_name) . " where ID_ENSEIGNANT= :ID_ENSEIGNANT";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ID_ENSEIGNANT' => $id]);
        return $stmt->fetchAll();

    }

    public function candidats()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        $class_name = explode('\\', Candidat::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for list all data */
        $sql = "select c.* from " . strtolower($table_name) . " c inner join candidat_classe cc on c.ID_CANDIDAT = cc.ID_CANDIDAT where $this->primaryKey = :$this->primaryKey";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([":$this->primaryKey" => $this->{$this->primaryKey}]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Candidat::class);

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }

}