<?php

const DB_HOSTNAME = "";
const DB_DATABASE = ""; // xname
const DB_USERNAME = ""; // xname
const DB_PASSWORD = ""; //heslo najdu na Esu

class DatabaseConnection {
    private static $pdo;

    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
};


abstract class Database {
    protected $pdo;
    protected $tableName;
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    public function find() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    protected function runQuery($query, $data) {
        $statement = $this->pdo->prepare($query);
        $statement->execute($data);
        return $statement;
    }
}
