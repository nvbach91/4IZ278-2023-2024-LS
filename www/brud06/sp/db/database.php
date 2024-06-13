<?php

require_once 'config.php';

class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME .
                    ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // test database connection by querying
            $statement = self::$pdo->prepare('SHOW TABLES');
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN);
            // echo implode('<br>', $results), PHP_EOL;
        }
        return self::$pdo;
    }
    public static function printConfig()
    {
        echo "Host: " . DB_HOSTNAME . ", Database: " . DB_DATABASE . ", User: " . DB_USERNAME;
    }
}

//$pdoConncetion=DatabaseConnection::getPDOConnection();

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
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    protected function runQuery($sql, $params = [])
    {
        $statement = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            if ($key === 'itemsPerPage' || $key === 'offset') {
                $statement->bindValue(':' . $key, $val, PDO::PARAM_INT);
            } else if (is_int($val)) {
                $statement->bindValue(':' . $key, $val, PDO::PARAM_INT);
            } else {
                $statement->bindValue(':' . $key, $val);
            }
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
