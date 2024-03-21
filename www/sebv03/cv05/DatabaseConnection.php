<?php
const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'starwars';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection
{
    private static PDO $pdo;
    public static function getPDOConnection(): PDO
    {
        if (!isset(self::$pdo)) {

            echo "Connecting to database."; //self::$pdo = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        }
        return self::$pdo;
    }
}
?>