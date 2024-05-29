<?php 
require __DIR__ .'/DatabaseOperations.php';
require __DIR__ .'/DatabaseConnection.php';

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    // přidat funkce
    public function readAll($tableName) {
        try {
            $sql = "SELECT * FROM `$tableName`";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: ". $e->getMessage();
        }
    }

    public function readCountAll($tableName, $tableId) {
        try {
            $sql = "SELECT COUNT($tableId) FROM $tableName";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: ". $e->getMessage();
        }
    }

    public function readAllByColumn($tableName, $column, $value){
        try {
            $sql = "SELECT * FROM $tableName WHERE $column = $value";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: ". $e->getMessage();
        }
    }
    
    public function deleteAll($tableName, $tableId, $value) {
        try {
            $sql = "DELETE FROM $tableName WHERE $tableId = $value;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: ". $e->getMessage();
        }
    }
    
}
?>