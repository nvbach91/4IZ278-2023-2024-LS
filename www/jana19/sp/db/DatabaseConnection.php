<?php

require __DIR__ . '/../config/constant.php';

class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) { // Existuje PDO connection?
            try {
                self::$pdo = new PDO(
                    'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
                    DB_USERNAME,
                    DB_PASSWORD
                );
                // Nastaví default fetch mode na associativní pole
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // Test database connection
                $statement = self::$pdo->prepare('SHOW TABLES');
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_COLUMN);
            
            // Odchycení výjimky
                // např. DB je dole, špatný login do DB, chyba spojení
            } catch (PDOException $e) {
                // zanese se do logu
                error_log("Database connection error: " . $e->getMessage());
                // Vyhodí výjimku znova - to se dělá pro případ že se sní bude dál pracovat jinde nepř. vyhodí se zpráva pro uživatele
                throw $e;
            }
        }
        return self::$pdo;
    }
}
