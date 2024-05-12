<?php

class DatabaseConnection {
    private static $instance = null;
    private $pdo;
    
    private const DB_HOSTNAME = 'localhost';
    private const DB_DATABASE = 'Eschool';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';
    
    private function __construct() {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . self::DB_HOSTNAME . ';dbname=' . self::DB_DATABASE,
                self::DB_USERNAME,
                self::DB_PASSWORD
            );
            
            // $statement = $this->pdo->prepare("SELECT * FROM Users;");
            // $statement->execute();
            // $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            // foreach($users as $value):
            //     echo $value['user_id'];
            //     echo $value['first_name'];
            // endforeach;
        }
        catch(PDOException) {
            // TODO
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