<?php
define('DB_NAME', 'nikd01');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'he7Jai9Pie9Eidei9R');

class DatabaseConnection
{
    private static $pdo;

    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASSWORD,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
        }
        return self::$pdo;
    }
}

interface DatabaseOperations
{
    public function create($data);

    public function find($query);

    public function update($query, $data);

    public function delete($query);
}

abstract class Database implements DatabaseOperations
{
    protected $pdo;

    public function __construct()
    {
        $pdo = DatabaseConnection::getPDOConnection();
    }
}