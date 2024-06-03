<?php

const DB_DATABASE = 'sp_eshop';
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
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}