<?php

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'reservation_system';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
            // aby se výsledky vracely ve formátu asociativního pole
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$pdo;
    }
    public static function getPDOConnectionParameters()
    {
        echo 'DB_HOSTNAME: "' . DB_HOSTNAME . '", DB_DATABASE: "' . DB_DATABASE . '", DB_USERNAME: "' . DB_USERNAME . '"';
    }
}