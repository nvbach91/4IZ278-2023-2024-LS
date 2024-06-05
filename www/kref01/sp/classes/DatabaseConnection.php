<?php

class DatabaseConnection {
    private static $instance = null;
    private $pdo;
    
    // private const DB_HOSTNAME = 'localhost';
    // private const DB_DATABASE = 'Eschool';
    // private const DB_USERNAME = 'root';
    // private const DB_PASSWORD = '';

    private const DB_HOSTNAME = 'localhost';
    private const DB_DATABASE = 'kref01';
    private const DB_USERNAME = 'kref01';
    private const DB_PASSWORD = '********'; // TODO replace with real password
    
    private function __construct() {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . self::DB_HOSTNAME . ';dbname=' . self::DB_DATABASE,
                self::DB_USERNAME,
                self::DB_PASSWORD
            );
        }
        catch (PDOException $e) {
            error_log('Database connection error: ' . $e->getMessage());
            die('Could not connect to the database. Please try again later.');
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

}

?>