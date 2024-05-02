<?php

const DB_DATABASE = 'eshop';
const DB_HOSTNAME = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection {
    private static $pdo;

    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . 
                ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD,
            );
        }
        return self::$pdo;
    }
}

abstract class Database {
    protected $pdo;

    public function __construct() {
       $this->pdo = DatabaseConnection::getPDOConnection(); 
    }
    
    public function findUser($email) {
        $statement = $this->pdo->prepare('SELECT * FROM cv10_users WHERE email = :email');
        $statement->execute(['email' => $email]);
        return $statement->fetchAll()[0];
    }

    public function registerUser($registrationData) {
        $statement = $this->pdo->prepare('INSERT INTO cv10_users (name, email, password) VALUES (:name, :email, :password)');
        $statement->execute(['name' => $registrationData['name'],
                             'email' => $registrationData['email'],
                             'password' => $registrationData['password']]);
    }
}
?>