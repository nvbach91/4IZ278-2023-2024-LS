<?php 
const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'starwars';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

// nepsat vsechno do jednoho souboru...

class DatabaseConnection {
    private static $pdo;
    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
            // test database connection by querying
            $statement = self::$pdo->prepare('SHOW TABLES');
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN);
            echo implode('<br>', $results), PHP_EOL;
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
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
}

class PlayersDB extends Database {
    public function create($data) {
        echo 'Players DB called method create';
        // $statment = $this->pdo->prepare('INSERT INTO players ...');
        // $statment->execute();
    }
    public function find($query) {}
    public function update($query, $data) {}
    public function delete($query) {}
}
/*class TeamsDB extends Database {

}
class MatchesDB extends Database {

}
*/
$playersDB = new PlayersDB();
$playersDB->create([]);

// $pdoConnection = DatabaseConnection::getPDOConnection();

?>