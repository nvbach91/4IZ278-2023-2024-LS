<?php

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'adad05';
const DB_USERNAME = 'adad05';
const DB_PASSWORD = 'chu3choesufujohaL9';

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
        }
        return self::$pdo;
    }
    public static function getPDOConnectionParameters()
    {
        echo 'DB_HOSTNAME: "' . DB_HOSTNAME . '", DB_DATABASE: "' . DB_DATABASE . '", DB_USERNAME: "' . DB_USERNAME . '"';
    }
}
