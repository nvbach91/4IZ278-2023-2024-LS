<?php

const DB_DATABASE = 'eshop';
const DB_HOSTNAME = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection {
    private static $pdo;

    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME .
                ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}

interface DatabaseOperations {
    public function find();
}

abstract class Database implements DatabaseOperations {
    protected $pdo;

    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    
    protected function runQuery($sql, $data) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $statement->fetchAll();
    }

    public function count() {
        //$statement = mysqli_query($this->pdo, 'SELECT COUNT(*) FROM cv08_goods');
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM cv08_goods');
        $statement->execute();
        $count = $statement->fetchColumn();
        return $count;
    }
}

?>