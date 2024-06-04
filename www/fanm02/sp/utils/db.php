<?php

interface IDatabaseOperations {
    public function runQuery($query, $data);
    public function prepare($sql);
}

abstract class Database implements IDatabaseOperations {

    protected $pdo;
    public function __construct() {
        $this->pdo = DatabaseConnection::getConnection();
    }

    public function logConfig() {
        echo 'Hostname: ' . DB_HOSTNAME . ', Name: ' . DB_NAME . ', Username: ' . DB_USER . ', Password: ' . DB_PASSWORD;
    }

    public function runQuery($sql, $data){
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $statement->fetchAll();
    } 

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }
}

class DatabaseConnection {

  private static $pdo;

  public static function getConnection() {

    if (!self::$pdo) {
        self::$pdo = new PDO(
            'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_NAME,
            DB_USER,
            DB_PASSWORD
        );
    }
    return self::$pdo;
  }
}
?>