<?php
//constants for db connection
const DB_HOSTNAME = 'localhost';
const DB_DATABASE = '';
const DB_USERNAME = '';
const DB_PASSWORD = '';

class DatabaseConnection
{
    private static $pdo;
    private function __construct()
    {
    }
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                //return error msg
                exit('Connection to DB failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
