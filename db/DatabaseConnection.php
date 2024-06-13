<?php
class DatabaseConnection
{

    private const HOST_NAME = "md405.wedos.net";
    private const DB_NAME = "d341941_spot";
    private const USER_NAME = "";
    private const PASSWORD = "";

    private static PDO $pdo;

     // private constructor will prevent instantiation of this class
    private function __construct(){}

    public static function getPDOConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::HOST_NAME . ";" . " dbname=" . self::DB_NAME, self::USER_NAME, self::PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->exec("set names utf8mb4");
            } catch (PDOException $e) {
                exit("Attempt to connect to database failed: " . $e->getMessage());
            }
        }

        return self::$pdo;

    }
}
?>
