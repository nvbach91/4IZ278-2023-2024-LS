<?php 

const DB_HOSTNAME = 'localhost';
const DB_DATABSE = 'eshop';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection {
    private static $pdo;
    
    public static function getPDOConnection() {
        if (!self::$pdo) {
        self::$pdo = new PDO(
            'mysql:host=' . DB_HOSTNAME .
            ';dbname=' . DB_DATABSE,
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

abstract class Database implements DatabaseOperations{
    protected $pdo;
    
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    protected function runQuery($sql, $data) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $statement->fetchAll();
    }
}

?>