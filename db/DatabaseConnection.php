
<!-- TODO -->

<?php

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'becultureal';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

abstract class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (self::$pdo == null) {

            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}