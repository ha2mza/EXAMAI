<?php

namespace Examai\Examai\Models;

use PDO;
use PDOException;

abstract class Entity
{
    /* the name of primary key in $table_name */
    protected string $primaryKey = 'id';
    /*
     the table name in real database  / generate automatically if I found him empty via the class name
     */
    protected string $table_name;
    /* fields of table in real database table the schema should be like this
    [
    ...['name' => , 'type' => , 'default' =>]
    ]
     */
    protected array $columns = [];

    public function __construct()
    {
        $length = count($this->columns);
        for ($i = 0; $i < $length; $i++) {
            $this->{$this->columns[$i]['name']} = $this->columns[$i]['default'];
        }
    }

    /*
    function can insert data dynamically via attribute columns , primary key , table_name
    */
    public function create()
    {
        /* a singleton class for making one instance */
        /* singleton is a design pattern concept in oop */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        if (empty($table_name)) {
            $class_name = explode('\\', strtolower(get_class($this)));
            $this->table_name = $class_name[count($class_name) - 1];
        }

        /*
         for loop for creating syntaxe sql for insert with parameters  like that
        inset into (column1, column2) values (:column1, :column2)
        the for loop work to make only  (column1, column2) and (:column1, :column2)  without ()
        */

        $attributes = get_object_vars($this);
        $parameters = [":$this->primaryKey" => null];
        $columns = $this->primaryKey;
        $keys = ':' . $this->primaryKey;
        $length = count($this->columns);
        for ($i = 0; $i < $length; $i++) {
            $columns .= "," . $this->columns[$i]['name'];
            $keys .= ",:" . $this->columns[$i]['name'];
            $parameters[$this->columns[$i]['name']] = $attributes[$this->columns[$i]['name']];
        }

        /* after finish generating query dynamically send that to pdo for what! for executing ;) */

        $sql = "insert into $this->table_name ($columns) values ($keys)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue($this->primaryKey, null, PDO::PARAM_INT);
        for ($i = 0; $i < $length; $i++) {
            switch ($this->columns[$i]['type']) {
                case 'integer':
                    $statement->bindValue($this->columns[$i]['name'], $attributes[$this->columns[$i]['name']], PDO::PARAM_INT);
                    break;
                case 'boolean':
                    $statement->bindValue($this->columns[$i]['name'], $attributes[$this->columns[$i]['name']], PDO::PARAM_BOOL);
                    break;
                default:
                    $statement->bindValue($this->columns[$i]['name'], $attributes[$this->columns[$i]['name']]);
                    break;
            }
        }
        $execute = $statement->execute();

        /* if $execute is true so the data inserted (^_^) */
        if ($execute)
            $this->{$this->primaryKey} = $pdo->lastInsertId();

        return $execute;
    }

    /*
    function can update data dynamically via attribute columns , primary key , table_name
    */
    public function update()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();


        /* generate table_name from class automatically */
        if (empty($table_name)) {
            $class_name = explode('\\', strtolower(get_class($this)));
            $this->table_name = $class_name[count($class_name) - 1];
        }

        /*
       for loop for creating syntaxe sql for updating with parameters  like that
      update table_name set (column1 = :column1, column2= :column2) where $primarykey = :primarykey
      the for loop work to make only  (column1 = :column1, column2= :column2)  without ()
      */

        $attributes = get_object_vars($this);
        $parameters = [":$this->primaryKey" => $attributes[$this->primaryKey]];
        $columns = '';
        $length = count($this->columns);
        for ($i = 0; $i < $length; $i++) {
            if ($i < $length - 1)
                $columns .= $this->columns[$i]['name'] . "= :" . $this->columns[$i]['name'] . ", ";
            else
                $columns .= $this->columns[$i]['name'] . "= :" . $this->columns[$i]['name'];
            $parameters[":" . $this->columns[$i]['name']] = $attributes[$this->columns[$i]['name']];
        }


        /* after finish preparing my statement dynamically send that to pdo for what! for executing ;) */
        $sql = "update $this->table_name set $columns where $this->primaryKey = :$this->primaryKey";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":" . $this->primaryKey, $attributes[$this->primaryKey], PDO::PARAM_INT);
        for ($i = 0; $i < $length; $i++) {
            switch ($this->columns[$i]['type']) {
                case 'integer':
                    $statement->bindValue(":" . $this->columns[$i]['name'], $attributes[$this->columns[$i]['name']], PDO::PARAM_INT);
                    break;
                case 'boolean':
                    $statement->bindValue(":" . $this->columns[$i]['name'], $attributes[$this->columns[$i]['name']], PDO::PARAM_BOOL);
                    break;
                default:
                    $statement->bindValue(":" . $this->columns[$i]['name'], $attributes[$this->columns[$i]['name']]);
                    break;
            }
        }

        return $statement->execute();
    }

    /*
    function can delete data dynamically via attribute columns , primary key , table_name
    */
    public function delete()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        if (empty($table_name)) {
            $class_name = explode('\\', strtolower(get_class($this)));
            $this->table_name = $class_name[count($class_name) - 1];
        }

        /*
        a no for loop her, but we are writing a few code for creating a dynamic query to delete my lovely data :(
        the syntaxe for deleting should be like that : delete from table_name where $primarykey = :primarykey
        and only pass primarykey in paramater
        */
        $attributes = get_object_vars($this);
        $parameters = [":$this->primaryKey" => $attributes[$this->primaryKey]];

        $sql = "delete from $this->table_name where $this->primaryKey = :$this->primaryKey";

        /* after finish preparing my statement dynamically send that to pdo for what! for deleting (o.o) */
        $statement = $pdo->prepare($sql);
        return $statement->execute($parameters);
    }

    /*
    function getting data dynamically via class_name
    */
    public static function get()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for list all data */
        $sql = "select * from " . strtolower($table_name);
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);

        /* getting all data  via  fetchAll method */
        return $stmt->fetchAll();
    }


    /*
    function getting data by column dynamically via class_name
    */
    public static function firstBy($column_name, $id)
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();

        /* generate table_name from class automatically */
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for list all data */
        $sql = "select * from " . strtolower($table_name) . " where $column_name = :$column_name limit 1";
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute([":$column_name" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);

        /* getting all data  via  fetchAll method */
        return $stmt->fetch();
    }

    /* get value for primary key */
    public function getID()
    {
        return $this->{$this->primaryKey};
    }

    /* clear les donnes de la table */
    public static function truncate()
    {
        /* a singleton class for making one instance */
        $pdo = \Connection::instance();
        $pdo->query('SET foreign_key_checks = 0');
        /* generate table_name from class automatically */
        $class_name = explode('\\', static::class);
        $table_name = $class_name[count($class_name) - 1];

        /* a query statement for truncate all data */
        $sql = "truncate " . strtolower($table_name);
        $stmt = $pdo->prepare($sql);

        /* after finish preparing my statement dynamically send that to pdo for executing  */
        $stmt->execute();

        $pdo->query('SET foreign_key_checks = 1');
    }
}