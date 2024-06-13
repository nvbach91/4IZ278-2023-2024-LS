<?php

use Dotenv\Dotenv;
include '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

class DatabaseConnection {
    private static $pdo;

    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . $_ENV['DB_HOSTNAME'] .
                ';dbname=' . $_ENV['DB_DATABASE'],
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD'],
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        }
        return self::$pdo;
    }
}