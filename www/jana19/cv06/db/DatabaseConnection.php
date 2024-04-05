<?php

require __DIR__ .'/../config/constant.php';

class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) { // pouze pokud není vytvořené připojení se vytvoří nové
            // na statickou proměnnou se odkazujeme přes self::
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
            // vrátí výseledky v asociativním poli
            self::$pdo ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // test database connection
            $statement = self::$pdo->prepare('SHOW TABLES');
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN);
            
        }
        return self::$pdo;
    }
}

?>