<?php

const DB_HOSTNAME = '';
const DB_DATABASE = '';
const DB_USERNAME = '';
const DB_PASSWORD = '';


class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$pdo;
    }
}

interface DatabaseOperations
{
    public function create($data);
    public function find($query);
    public function findAll();
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

    protected function runQuery($query, $data)
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($data);
        return $statement;
    }
}
