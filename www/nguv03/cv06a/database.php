<?php 
const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'starwars'; // na eso to bude vas xname
const DB_USERNAME = 'root';     // na eso to bude vas xname
const DB_PASSWORD = '';         // najdete na ftp v winscp / filezilla viz wiki

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
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // test database connection by querying
            $statement = self::$pdo->prepare('SHOW TABLES');
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN);
            // echo implode('<br>', $results), PHP_EOL;
        }
        return self::$pdo;
    }
}

interface DatabaseOperations {
    // public function createx($data);
    public function create($data);
    public function find($query);
    public function findAll();
    public function update($query, $data);
    public function delete($query);
}

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    protected function runQuery($sql, $data) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $statement->fetchAll();
    }
}
class PlayersDB extends Database {
    // public function create($data) {}
    public function create($data) {
        return $this->runQuery(
            'INSERT INTO players(name) VALUES (:name);',
            ['name' => $data['name']]
        );
    }
    // read some data from database
    public function find($query) {
        return $this->runQuery(
            'SELECT * FROM players WHERE name = :name;',
            ['name' => $query['name']]
        );
    }
    public function findAll() {
        return $this->runQuery(
            'SELECT * FROM players;',
            []
        );
    }
    public function update($query, $data) {
        // ...
    }
    public function delete($query) {
        return $this->runQuery(
            'DELETE FROM players WHERE name = :name;',
            ['name' => $query['name']]
        );
    }
}

// $playersDB = new PlayersDB()
/*class TeamsDB extends Database {

}
class MatchesDB extends Database {

}
*/
// $playersDB = new PlayersDB();
// $playersDB->create([]);

// $pdoConnection = DatabaseConnection::getPDOConnection();

?>