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

    // Tohle dynamický hledání jsem si musela najít na gitu, to bych dohromady nedala
    public function find() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public function findWhere($field, $value) {
        $sql = "SELECT * FROM $this->tableName 
        WHERE $field = :value;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
        return $statement->fetchAll();
    }
    
    public function updateWhere($conditions, $columns) {
        $sql = "UPDATE $this->tableName SET ";
        $sets = [];
        foreach ($columns as $key => $value) {
            $sets[] = "$key = : $key";
        }
        $sql .= implode(', ', $sets);
        $sql .= " WHERE ";
        $wheres = [];
        foreach ($conditions as $key => $value) {
            $wheres[] = "$key = : $key";
        }
        $sql .= implode(' && ', $wheres);
        // echo $sql;
        $statement = $this->pdo->prepare($sql);
        foreach ($columns as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach ($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }
    // common implementation for all concrete classes
    public function deleteWhere($field, $value) {
        $sql = "DELETE FROM $this->tableName 
        WHERE $field = :value;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}
?>