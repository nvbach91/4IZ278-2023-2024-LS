<?php

class DatabaseConnection {
    private static $instance = null;
    // private $pdo;
    private const DB_HOSTNAME = 'localhost';
    private const DB_DATABASE = 'starwars';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';

    private function __construct() {
        // Nasledujici blok crashuje stranku. Prepdokladam, ze kvuli tomu, 
        // ze zadavam neplatne prihlasovaci udaje. Na minulem cviku jsem 
        // z duvodu nemoci nemohl byt a nevim, jake prihlasovaci udaje
        // by byly platne

        // $this->pdo = new PDO(
        //     'mysql:host=' . self::DB_HOSTNAME . ';dbname=' . self::DB_DATABASE,
        //     self::DB_USERNAME,
        //     self::DB_PASSWORD
        // );
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // public function getPDO() {
    //     return $this->pdo;
    // }

    public function printConnectionCredentials() {
        echo "database config: host: " . self::DB_HOSTNAME . ", dbname: " . self::DB_DATABASE . ", username: " . self::DB_USERNAME;
    }
}
?>