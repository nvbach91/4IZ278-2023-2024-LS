<?php
define('DB_NAME', 'cv06');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

class DatabaseConnection
{
  private static $pdo;
  public static function getPDOConnection()
  {
    if (!self::$pdo) {
      self::$pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASSWORD,
        array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
      );
      self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return self::$pdo;
  }
}

abstract class DatabaseEshop
{
  protected $pdo;
  public function __construct()
  {
    $this->pdo = DatabaseConnection::getPDOConnection();
  }

  protected function runQuery($query, $data)
  {
    $statement = $this->pdo->prepare($query);
    $statement->execute($data);
    return $statement->fetchAll();
  }
}
