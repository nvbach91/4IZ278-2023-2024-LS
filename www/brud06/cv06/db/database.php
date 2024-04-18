<?php

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'brud06'; //xname
const DB_USERNAME = ''; //xname or root
const DB_PASSWORD = '';

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
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
              // test database connection by querying
              $statement = self::$pdo->prepare('SHOW TABLES');
              $statement->execute();
              $results = $statement->fetchAll(PDO::FETCH_COLUMN);
              // echo implode('<br>', $results), PHP_EOL;
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
        $this->pdo = DatabaseConnection::getPDOConnection();
   }
   protected function runQuery($sql,$data){
         $statement = $this->pdo->prepare($sql);
         $statement->execute($data);
         return $statement->fetchAll();
        
   }
}

class PlayersDB extends Database{
 public function create($data){
    echo 'players db called method create'. PHP_EOL;
    $statement = $this->pdo->prepare("INSERT INTO players(name
    ) VALUES(:name)");
    $statement->execute(
        [
            'name' => $data['name']
        ]
    );
 }
 public function find($query){
    echo 'players db called method find' . PHP_EOL;
        //$statement = $this->pdo->prepare("SELECT * FROM players WHERE name = :name
        //");
        //$statement->execute([
            //'name' => $query['name']
        //]);
        //$results = $statement->fetchAll();
        //var_dump($results);
        //return $results;
        return $this->runQuery("SELECT * FROM players WHERE name = :name", ['name' => $query['name']]);
 }
 public function findAll($query){
    return $this->runQuery("SELECT * FROM players", []);
 }
 public function update($query, $data){ 
    echo 'players db called method update' . PHP_EOL;
 }
 public function delete($data){
    //echo 'players db called method delete'.PHP_EOL;
    //$statement = $this->pdo->prepare("DELETE FROM players WHERE name = :name");
    //$statement->execute([
        //'name' => $data['name']
    //]);
    return $this->runQuery("DELETE FROM players WHERE name = :name", ['name' => $data['name']]);
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


?>