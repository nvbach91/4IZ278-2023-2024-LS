<?php

class DatabaseConnection {
    private static $instance = null;
    private $pdo;

    private const DB_HOSTNAME = 'localhost'; // 'localhost' | 'eso.vse.cz'
    private const DB_DATABASE = 'starwars';  // 'starwars' |  'kref01'
    private const DB_USERNAME = 'root';      // 'root' | 'kref01'
    private const DB_PASSWORD = '';          // '' | <password>
    
    // private const DB_HOSTNAME = 'eso.vse.cz';
    // private const DB_DATABASE = 'kref01';
    // private const DB_USERNAME = 'kref01';
    // private const DB_PASSWORD =  <password>;
    
    private function __construct() {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . self::DB_HOSTNAME . ';dbname=' . self::DB_DATABASE,
                self::DB_USERNAME,
                self::DB_PASSWORD
            );
            
            // $statement = $this->pdo->prepare("SELECT * FROM players WHERE 1");
            // $statement->execute();
            // $players = $statement->fetchAll(PDO::FETCH_ASSOC);
            // foreach($players as $value):
            //     echo $value['player_id'];
            //     echo $value['name'];
            // endforeach;
        }
        catch(PDOException) {
            // echo "Nope";
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function printConnectionCredentials() {
        echo "database config: host: " . self::DB_HOSTNAME . ", dbname: " . self::DB_DATABASE . ", username: " . self::DB_USERNAME;
    }
}

?>