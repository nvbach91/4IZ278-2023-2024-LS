<?php require_once __DIR__ . '/DatabaseConnection.php'; ?>
<?php require_once __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    protected $tableName; // $tableName will be specified in child classes
    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    // common implementation for all concrete classes
    public function find() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    // common implementation for all concrete classes
    public function findBy($field, $value) {
        // PREPARED STATEMENT: POSITIONAL PARAMS
        // $sql = "SELECT * FROM $this->tableName WHERE $field = ?";
        // $statement = $this->pdo->prepare($sql);
        // $statement->bindValue(1, $value);
        // $statement->execute();
        // return $statement->fetchAll();

        // $sql = "SELECT * FROM $this->tableName WHERE $field = ?";
        // $statement = $this->pdo->prepare($sql);
        // $statement->execute([$value]);
        // return $statement->fetchAll();

        // PREPARED STATEMENT: NAMED PARAMS
        $sql = "SELECT * FROM $this->tableName WHERE $field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);

        // ROW COUNT
        // $rowCount = $statement->rowCount();

        return $statement->fetchAll();
    }
    // common implementation for all concrete classes
    public function updateBy($conditions, $args) {
        $sql = "UPDATE $this->tableName SET ";
        $sets = [];
        foreach ($args as $key => $value) {
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
        foreach ($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach ($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }
    // common implementation for all concrete classes
    public function deleteBy($field, $value) {
        $sql = "DELETE FROM $this->tableName WHERE $field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}

?>