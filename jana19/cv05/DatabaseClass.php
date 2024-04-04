<?php 
require './DatabaseOperations.php';
require './DatabaseConnection.php';
abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    protected function runQuery($sql, $data) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $statement->fetchAll();
    }
}
?>