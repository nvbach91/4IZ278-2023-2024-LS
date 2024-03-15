<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php

class DatabaseConnection {
    private static $pdo;
    // private constructor will prevent instantiation of this class
    private function __construct() {}
    public static function getPDOConnection() {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO('mysql:host='. DB_HOSTNAME .';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
                // test the connection by running a query
                // $statement = self::$pdo->prepare('SHOW TABLES');
                // $statement->execute([]);
                // $tables = $statement->fetchAll(PDO::FETCH_COLUMN);
                // var_dump($tables);
            } catch (PDOException $e) {
                exit('Connection to DB failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function printConfig() {
        return 'database config: host: ' . DB_HOSTNAME . ', dbname: ' . DB_DATABASE . ', username: ' . DB_USERNAME;
    }
}

?>