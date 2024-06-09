<?php

class Connection
{
    private static ?PDO $_instance = null;
    static $db = 'examai';

    public static function instance()
    {
        $host = 'localhost';
        $db = Connection::$db;
        $user = 'root';
        $pass = 'password';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        if (Connection::$_instance === null) {
            try {
                Connection::$_instance = new PDO($dsn, $user, $pass);
                Connection::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                Connection::$_instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            } catch (PDOException $e) {
                throw new Exception("Failed Connecting $host:$user:$db " . $e->getMessage());
            }
        }

        return Connection::$_instance;
    }
}
