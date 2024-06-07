<?php


class DbConnection{

    private const HOST_NAME = "localhost";
    private const DB_NAME = "chav07";
    private const USER_NAME = "root";
    private const PASSWORD = "";
    
    private static PDO $pdo;

    private function __construct() {
        //hidden
    }

    public static function getConnection(){
        if(!isset(self::$pdo)){
            try{
                self::$pdo = new PDO("mysql:host=". self::HOST_NAME.";"." dbname=". self::DB_NAME, self::USER_NAME, self::PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$pdo->exec("set names utf8mb4");
            }
            catch(PDOException $e){
                exit("Attempt to connect to database failed: " . $e->getMessage());
            }
        }
        
        return self::$pdo;

    }
}

?>
