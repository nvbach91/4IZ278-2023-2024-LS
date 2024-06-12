<?php require __DIR__ . '/DatabaseConnection.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>

<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    protected $tableName; 
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    public function find() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function findBy($field, $value) {
       
        $sql = "SELECT * FROM $this->tableName WHERE $field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
        
        return $statement->fetchAll();
    }


    public function updateBy($conditions, $args) {
        $sql = "UPDATE $this->tableName SET ";
        $sets = [];
        foreach ($args as $key => $value) {
            $sets[] = "$key = :$key";
        }
        $sql .= implode(', ', $sets);
        $sql .= " WHERE ";
        $wheres = [];
        foreach ($conditions as $key => $value) {
            $wheres[] = "$key = :$key";
        }
        $sql .= implode(' && ', $wheres);
        $statement = $this->pdo->prepare($sql);
        foreach ($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach ($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }
    public function deleteBy($field, $value) {
        $sql = "DELETE FROM $this->tableName WHERE $field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}


?>