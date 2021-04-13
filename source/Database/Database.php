<?php

namespace Source\Database;

use PDO;
use PDOException;

class Database extends PDO
{
    private static $_instance = null;

    public function __construct($_databaseName, $_user, $_password)
    {
        parent::__construct($_databaseName, $_user, $_password);
    }

    public static function getInstance(): Database
    {
        try {
            if (!isset(self::$_instance)) {
                self::$_instance = new Database("mysql:dbname=qi;host=localhost", "root", "");
            }
            return self::$_instance;
        } catch (PDOException $_error) {
            echo "Erro ao conectar! " . $_error;
            die();
        }
    }
}