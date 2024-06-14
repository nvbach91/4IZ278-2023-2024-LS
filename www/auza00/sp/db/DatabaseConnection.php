<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php
class DatabaseConnection
{
    private static PDO $pdo;
     // private constructor will prevent instantiation of this class
    private function __construct(){}

    public static function getPDOConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO('mysql:host=' . HOST_NAME . ';dbname=' . DB_NAME, USER_NAME, PASSWORD);
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