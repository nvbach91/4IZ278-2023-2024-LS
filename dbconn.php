<?php

// Konfigurační parametry pro připojení k MySQL databázi
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');

// Singleton třída pro vytvoření PDO připojení k databázi
class DatabaseConnection
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function printConfigParams()
    {
        echo "Host: " . DB_HOST . "<br>";
        echo "Database: " . DB_NAME . "<br>";
        echo "Username: " . DB_USER . "<br>";
        echo "Password: " . DB_PASSWORD . "<br>";
    }
}

// Rozhraní DatabaseOperations
interface DatabaseOperations
{
    public function create(...$params);
    public function find(...$params);
    public function update(...$params);
    public function delete(...$params);
}

// Abstraktní třída Database
abstract class Database implements DatabaseOperations
{
    protected $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnection::getInstance()->getConnection();
    }
}

// Podtřída PlayersDB
class PlayersDB extends Database
{
    public function create(...$params)
    {
        echo "Creating a new player record...<br>";
    }

    public function find(...$params)
    {
        echo "Finding a player record...<br>";
    }

    public function update(...$params)
    {
        echo "Updating a player record...<br>";
    }

    public function delete(...$params)
    {
        echo "Deleting a player record...<br>";
    }
}

// Podtřída TeamsDB
class TeamsDB extends Database
{
    public function create(...$params)
    {
        echo "Creating a new team record...<br>";
    }

    public function find(...$params)
    {
        echo "Finding a team record...<br>";
    }

    public function update(...$params)
    {
        echo "Updating a team record...<br>";
    }

    public function delete(...$params)
    {
        echo "Deleting a team record...<br>";
    }
}

// Podtřída MatchesDB
class MatchesDB extends Database
{
    public function create(...$params)
    {
        echo "Creating a new match record...<br>";
    }

    public function find(...$params)
    {
        echo "Finding a match record...<br>";
    }

    public function update(...$params)
    {
        echo "Updating a match record...<br>";
    }

    public function delete(...$params)
    {
        echo "Deleting a match record...<br>";
    }
}

// Testování
$dbConnection = DatabaseConnection::getInstance();
$dbConnection->printConfigParams();

$playersDB = new PlayersDB();
$playersDB->create();
$playersDB->find();
$playersDB->update();
$playersDB->delete();

$teamsDB = new TeamsDB();
$teamsDB->create();
$teamsDB->find();
$teamsDB->update();
$teamsDB->delete();

$matchesDB = new MatchesDB();
$matchesDB->create();
$matchesDB->find();
$matchesDB->update();
$matchesDB->delete();