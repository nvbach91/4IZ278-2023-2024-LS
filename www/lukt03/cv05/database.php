<?php

require './database-config.php';

// $pdo = DatabaseConnection::getPdoConnection();
class DatabaseConnection {
    private static $pdo;

    public static function getPdoConnection() {
        echo nl2br('Get PDO connection' . PHP_EOL);
        if (!self::$pdo) {
            self::$pdo = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD);
            echo nl2br('Initialized new PDO connection' . PHP_EOL);
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

abstract class Database implements DatabaseOperations {
    protected $pdo;

    public function __construct() {
        echo nl2br('Database instance constructed' . PHP_EOL);
        $this->pdo = DatabaseConnection::getPdoConnection();
    }
}

class PlayersDB extends Database {
    public function create($data) {
        echo nl2br('PlayersDB.create(' . json_encode($data) . ')' . PHP_EOL);
    }

    public function find($query) {
        echo nl2br('PlayersDB.find(' . json_encode($query) . ')' . PHP_EOL);
    }

    public function update($query, $data) {
        echo nl2br('PlayersDB.update(' . json_encode($query) . ' , ' . json_encode($data) . ')' . PHP_EOL);
    }

    public function delete($query) {
        echo nl2br('PlayersDB.delete(' . json_encode($query) . ')' . PHP_EOL);
    }
}

class TeamsDB extends Database {
    public function create($data) {
        echo nl2br('TeamsDB.create(' . json_encode($data) . ')' . PHP_EOL);
    }

    public function find($query) {
        echo nl2br('TeamsDB.find(' . json_encode($query) . ')' . PHP_EOL);
    }

    public function update($query, $data) {
        echo nl2br('TeamsDB.update(' . json_encode($query) . ' , ' . json_encode($data) . ')' . PHP_EOL);
    }

    public function delete($query) {
        echo nl2br('TeamsDB.delete(' . json_encode($query) . ')' . PHP_EOL);
    }
}

class MatchesDB extends Database {
    public function create($data) {
        echo nl2br('MatchesDB.create(' . json_encode($data) . ')' . PHP_EOL);
    }

    public function find($query) {
        echo nl2br('MatchesDB.find(' . json_encode($query) . ')' . PHP_EOL);
    }

    public function update($query, $data) {
        echo nl2br('MatchesDB.update(' . json_encode($query) . ' , ' . json_encode($data) . ')' . PHP_EOL);
    }

    public function delete($query) {
        echo nl2br('MatchesDB.delete(' . json_encode($query) . ')' . PHP_EOL);
    }
}
