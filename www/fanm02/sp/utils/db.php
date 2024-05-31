<?php

define('DB_HOSTNAME', 'localhost');
define('DB_NAME', 'sp');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mypass');

interface IDatabaseOperations {
    public function runQuery($query, $data);
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