<?php ?>
<?php 

require 'database-constants.php';

class DatabaseConnection{
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

    public static function getConfigParams() {
        return array(
            'hostname' => DB_HOSTNAME,
            'dbname' => DB_DATABASE,
            'username' => DB_USERNAME,
            'password' => DB_PASSWORD
        );
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

class PlayersDB extends Database{
    public function create($data) {
        echo 'Players DB called method create';
    }

    public function find($query) {
        echo 'Players DB called method find';
    }

    public function update($query, $data) {
        echo 'Players DB called method update';
    }

    public function delete($query) {
        echo 'Players DB called method delete';
    }
}

class TeamsDB extends Database{
    public function create($data) {
        echo 'Teams DB called method create';
    }

    public function find($query) {
        echo 'Teams DB called method find';
    }

    public function update($query, $data) {
        echo 'Teams DB called method update';
    }

    public function delete($query) {
        echo 'Teams DB called method delete';
    }
}

class MatchesDB extends Database{
    public function create($data) {
        echo 'Matches DB called method create';
    }

    public function find($query) {
        echo 'Matches DB called method find';
    }

    public function update($query, $data) {
        echo 'Matches DB called method update';
    }

    public function delete($query) {
        echo 'Matches DB called method delete';
    }
}

?>
