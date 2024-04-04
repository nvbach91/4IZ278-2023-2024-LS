<?php

define('DB_HOSTNAME', 'localhost');
define('DB_NAME', 'fanm02');
define('DB_USER', 'fanm02');
define('DB_PASSWORD', 'eh9keiNg3ze9eej9du');

interface IDatabaseOperations {
    public function create($query);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
  }

abstract class Database implements IDatabaseOperations {

    protected $pdo;
    public function __construct() {
        $this->pdo = DatabaseConnection::getConnection();
    }

    public function logConfig() {
        echo 'Hostname: ' . DB_HOSTNAME . ', Name: ' . DB_NAME . ', Username: ' . DB_USER . ', Password: ' . DB_PASSWORD;
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