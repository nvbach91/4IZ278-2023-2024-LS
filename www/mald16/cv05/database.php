<?php

const DB_HOSTNAME = "localhost";
const DB_DATABASE = "mald16"; // xname
const DB_USERNAME = "mald16"; // xname
const DB_PASSWORD = ""; //heslo najdu na Esu

class DatabaseConnection {
    private static $pdo;

    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
};

// DŮ: Pouze volat metody a ujistit se, že byly zavolány (nevstupovat do DB?) vypisovat echo
// rozdělit do vlastních souborů

interface DatabaseOperations {
    public function create($data);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
}

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
}

class PlayersDB extends Database {
    public function create($data) {
        echo "PlayersDB called method create";
        //$statement = $this->pdo->prepare("INSERT INTO players ...");
        //$statement->execute();
    }
    public function find($query) {
        echo "PlayersDB called method find";
    }
    public function update($query, $data) {
        echo "PlayersDB called method update";
    }
    public function delete($query) {
        echo "PlayersDB called method delete";
    }
}
class TeamsDB extends Database {
    public function create($data) {
        echo "TeamsDB called method create";
    }
    public function find($query) {
        echo "TeamsDB called method find";
    }
    public function update($query, $data) {
        echo "TeamsDB called method update";
    }
    public function delete($query) {
        echo "TeamsDB called method delete";
    }
}
class MatchesDB extends Database {
    public function create($data) {
        echo "MatchesDB called method create";
    }
    public function find($query) {
        echo "MatchesDB called method find";
    }
    public function update($query, $data) {
        echo "MatchesDB called method update";
    }
    public function delete($query) {
        echo "MatchesDB called method delete";
    }
}

// Když potřebuji ve třídách přístup, zavolám:
// $pdoConnection = DatabaseConnection::getPDOConnection();

//$playersDB = new PlayersDB();
//$playersDB->create([]);
