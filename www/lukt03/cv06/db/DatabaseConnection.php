<?php

require_once __DIR__ . '/../config/config.php';

class DatabaseConnection {
    private static $pdo;

    public static function getPdoConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD);
        }
        return self::$pdo;
    }
}
