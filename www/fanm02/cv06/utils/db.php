<?php

define('DB_HOSTNAME', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');

interface IDatabaseOperations {
    #public function create($query);
    public function find();
    #public function update($query, $data);
    #public function delete($query);
  }

abstract class Database implements IDatabaseOperations {

    protected $pdo;
    public function __construct() {
        $this->pdo = DatabaseConnection::getConnection();
    }

    public function logConfig() {
        echo 'Hostname: ' . DB_HOSTNAME . ', Name: ' . DB_NAME . ', Username: ' . DB_USER . ', Password: ' . DB_PASSWORD;
    }

    protected function runQuery($sql, $data){
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