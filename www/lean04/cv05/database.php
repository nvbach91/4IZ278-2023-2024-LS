<?php

const DB_HOSTNAME = '';
const DB_DATABASE = '';
const DB_USERNAME = '';
const DB_PASSWORD = '';

class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
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
    public function create($data)
    {
        // $statement = $this->pdo->prepare("INSERT INTO players (name, age) VALUES (:name, :age)");
        // $statement->execute($data);
        return 'Created a player';
    }
    public function find($query)
    {
        // $statement = $this->pdo->prepare("SELECT * FROM players WHERE " . $query);
        // $statement->execute();
        // return $statement->fetchAll(PDO::FETCH_ASSOC);
        return 'Found a player';
    }
    public function update($query, $data)
    {
        // $statement = $this->pdo->prepare("UPDATE players SET name = :name, age = :age WHERE " . $query);
        // $statement->execute($data);
        return 'Updated a player';
    }
    public function delete($query)
    {
        // $statement = $this->pdo->prepare("DELETE FROM players WHERE " . $query);
        // $statement->execute();
        return 'Deleted a player';
    }
}

class TeamsDB extends Database
{
    public function create($data)
    {
        return 'Created a team';
    }
    public function find($query)
    {
        return 'Found a team';
    }
    public function update($query, $data)
    {
        return 'Updated a team';
    }
    public function delete($query)
    {
        return 'Deleted a team';
    }
}

class MatchesDB extends Database
{
    public function create($data)
    {
        return 'Created a match';
    }
    public function find($query)
    {
        return 'Found a match';
    }
    public function update($query, $data)
    {
        return 'Updated a match';
    }
    public function delete($query)
    {
        return 'Deleted a match';
    }
}
