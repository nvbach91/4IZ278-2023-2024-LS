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

    public function findBy($field, $value) {

        $sql = "SELECT * FROM $this->tableName WHERE $field = :value";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);

        return $statement->fetchAll();
    }

}

?>