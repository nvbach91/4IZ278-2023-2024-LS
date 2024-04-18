<?php 

const DB_HOSTNAME = 'localhost';
const DB_DATABSE = 'starwars';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection {
    private static $pdo;
    
    public static function getPDOConnection() {
        if (!self::$pdo) {
        self::$pdo = new PDO(
            'mysql:host=' . DB_HOSTNAME .
            ';dbname=' . DB_DATABSE,
            DB_USERNAME,
            DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}

interface DatabaseOperations {
    public function create($data);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
}

abstract class Database implements DatabaseOperations{
    protected $pdo;
    
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
}

class PlayersDB extends Database {
    public function create($data) {
        echo 'Players DB called method create';
    }
    public function findAll(){}
    public function find($data) {
        echo 'Players DB called method find';
    }
    public function update($query, $data) {
        echo 'Players DB called method update';
    }
    public function delete($query) {
        echo 'Players DB called method delete';
    }
}

class TeamsDB extends Database {
    public function create($data) {
        echo 'Teams DB called method create';
    }
    public function findAll(){}
    public function find($data) {
        echo 'Teams DB called method find';
    }
    public function update($query, $data) {
        echo 'Teams DB called method update';
    }
    public function delete($query) {
        echo 'Teams DB called method create';
    }
}

class MatchesDB extends Database {
    public function create($data) {
        echo 'Matches DB called method create';
    }
    public function findAll(){}
    public function find($data) {
        echo 'Matches DB called method create';
    }
    public function update($query, $data) {
        echo 'Matches DB called method create';
    }
    public function delete($query) {
        echo 'Matches DB called method create';
    }
}

?>