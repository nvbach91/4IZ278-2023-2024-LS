<?php
const DB_HOSTNAME = 'localhost';
const DB_NAME = 'kouv13';
const DB_USERNAME = 'kouv13';
const DB_PASSWORD = ''; //


class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}



interface DatabaseOperations
{
    public function create($data);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
}


abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
}


class PlayersDB extends Database
{
    function getTables()
    {
        $st = $this->pdo->prepare('SELECT table_name
        FROM information_schema.tables
        WHERE table_schema = \'kouv13\';');
        $st->execute();
        $result = $st->fetchAll();
        return $result;
    }
    public function create($data)
    {
        //$statement = $this->pdo->prepare('INSERT INTO players');
        //$statement->execute();
        return 'Přidání hráče.';
    }
    public function find($query)
    {
        return 'Hledání hráče.';
    }
    public function update($query, $data)
    {
        return 'Update hráče.';
    }
    public function delete($query)
    {
        return 'Smazání hráče.';
    }
}

class TeamsDB extends Database
{
    public function create($data)
    {
        //$statement = $this->pdo->prepare('INSERT INTO players');
        //$statement->execute();
        return 'Přidání Týmu.';
    }
    public function find($query)
    {
        return 'Hledání týmu.';
    }
    public function update($query, $data)
    {
        return 'Update týmu.';
    }
    public function delete($query)
    {
        return 'Smazání týmu.';
    }
}

class MatchesDB extends Database
{
    public function create($data)
    {
        //$statement = $this->pdo->prepare('INSERT INTO players');
        //$statement->execute();
        return 'Přidání zápasu.';
    }
    public function find($query)
    {
        return 'Hledání zápasu.';
    }
    public function update($query, $data)
    {
        return 'Update zápasu.';
    }
    public function delete($query)
    {
        return 'Smazání zápasu.';
    }
}

$playersDB = new PlayersDB;
$playersDB->create([]);
$matchesDB = new MatchesDB;
$matchesDB->create([]);
$teamsDB = new TeamsDB;
$teamsDB->create([]);

//$pdoConnection = DatabaseConnection::getPDOConnection();