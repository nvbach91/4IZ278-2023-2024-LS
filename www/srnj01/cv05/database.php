<?php


const DB_HOST = 'localhost';
const DB_NAME = 'starwars';
const DB_USER = 'root';
const DB_PASS = '';

class DatabaseConnection
{
  private static $pdo;
  public static function getPDOConnection()
  {
    if (self::$pdo === null) {
      self::$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }
    return self::$pdo;
  }
}

interface DatabaseOperations
{
  public function create($data);
  public function read($id);
  public function update($id, $data);
  public function delete($id);
}

abstract class Database implements DatabaseOperations
{
  protected $pdo;
  public function __construct()
  {
    $pdo = DatabaseConnection::getPDOConnection();
  }
}

class PlayersDB extends Database
{
  public function create($data)
  {
    echo "PlayersDB create";
  }
  public function read($id)
  {
    echo "PlayersDB read";
  }
  public function update($id, $data)
  {
    echo "PlayersDB update";
  }
  public function delete($id)
  {
    echo "PlayersDB delete";
  }
}

class TeamsDB extends Database
{
  public function create($data)
  {
    echo "TeamsDB create";
  }
  public function read($id)
  {
    echo "TeamsDB read";
  }
  public function update($id, $data)
  {
    echo "TeamsDB update";
  }
  public function delete($id)
  {
    echo "TeamsDB delete";
  }
}

class MatchesDB extends Database
{
  public function create($data)
  {
    echo "MatchesDB create";
  }
  public function read($id)
  {
    echo "MatchesDB read";
  }
  public function update($id, $data)
  {
    echo "MatchesDB update";
  }
  public function delete($id)
  {
    echo "MatchesDB delete";
  }
}
