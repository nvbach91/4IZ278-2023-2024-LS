<?php

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'brud06'; //xname
const DB_USERNAME = 'brud06'; //xname or root
const DB_PASSWORD = 'aeCh7mei9mohb7kahj'; //home through eso - mysql.txt

class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME .
                    ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
    public static function printConfig() {
        echo "Host: ".DB_HOSTNAME.", Database: ".DB_DATABASE.", User: ".DB_USERNAME;
    }
}

//$pdoConncetion=DatabaseConnection::getPDOConnection();

interface DatabaseOperations{
    public function create($data);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
}

abstract class Database implements DatabaseOperations{
    protected $pdo;
   public function __construct(){
    $pdo = DatabaseConnection::getPDOConnection();
   }
}

class PlayersDB extends Database{
 public function create($data){
    echo 'players db called method create'. PHP_EOL;
    //$statement = $this->pdo->prepare("INSERT INTO players ...");
    //$statement->execute();
 }
 public function find($query){
    echo 'players db called method find' . PHP_EOL;
 }
 public function update($query, $data){ 
    echo 'players db called method update' . PHP_EOL;
 }
 public function delete($data){
    echo 'players db called method delete'.PHP_EOL;
 }
}
class TeamsDB extends Database{
    public function create($data){
        echo 'teams db called method create'.PHP_EOL;
    }
    public function find($query){
        echo 'teams db called method find'.PHP_EOL;
    }
    public function update($query, $data){
        echo 'teams db called method update'.PHP_EOL;
    }
    public function delete($data){
        echo 'teams db called method delete'.PHP_EOL;
    }

}
class MatchesDB extends Database{
    public function create($data){
        echo 'matches db called method create';
    }
    public function find($query){
        echo 'matches db called method find';
    }
    public function update($query, $data){
        echo 'matches db called method update';
    }
    public function delete($data){
        echo 'matches db called method delete';
    }
}

/*$playersDB = new PlayersDB();
$playersDB->create([]);
$playersDB->find([]);
$playersDB->update([],[]);
$playersDB->delete([]);

$matchesDB = new MatchesDB();
$matchesDB->create([]);
$matchesDB->find([]);
$matchesDB->update([],[]);
$matchesDB->delete([]);

$teamsDB = new TeamsDB();
$teamsDB->create([]);
$teamsDB->find([]);
$teamsDB->update([],[]);
$teamsDB->delete([]);
*/


?>