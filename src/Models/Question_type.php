<?php

namespace Examai\Examai\Models;
/*
class Question_type extends Entity
{
    protected string $primaryKey = 'ID_QUESTION_TYPE';
    protected array $columns = [
        ['name' => 'NOM', 'type' => 'string', 'default' => null],
        ['name' => 'CODE', 'type' => 'string', 'default' => null]
    ];

}
*/

class Question_type
{
    const ONECHOICE = 1;
    const MULTICHOICE = 2;
    const SWITCH = 3;

    public static function select2format()
    {

        $pdo = \Connection::instance();
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];
        $sql = "select ID_QUESTION_TYPE as id , NOM as text from " . strtolower($table_name);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}