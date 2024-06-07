<?php require_once __DIR__ . '/DatabaseConnection.php'; ?>
<?php

abstract class Database{
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

    public function findBy($field, $value, $fetchAll = true) {
        $sql = "SELECT * FROM $this->tableName WHERE $field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    
        return $fetchAll ? $statement->fetchAll() : $statement->fetch();
    }
    

    public function findByJoin($joinTable, $foreignKey, $localKey, $field, $value) {
        $sql = "SELECT t.* FROM $this->tableName t
                JOIN $joinTable jt ON t.$localKey = jt.$foreignKey
                WHERE jt.$field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
        return $statement->fetchAll();
    }

}

?>