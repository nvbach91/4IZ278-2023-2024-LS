<?php require __DIR__ . '/DatabaseConnection.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>
<?php
abstract class Database implements DatabaseOperations
{
    protected $pdo;
    protected $tableName;
    //specific table names are specified in child classes

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    //run query statement - sql injection
    protected function runQuery($sql, $data)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM $this->tableName";
        $params = []; //TODO
        $this->runQuery($sql, $params);
    }

    public function fetchBy($field, $value)
    {
        $sql = "SELECT * FROM $this->tableName WHERE $field = :value";
        $params = []; //TODO (bind values)
        $this->runQuery($sql, $params);
    }

    public function updateBy($conditions, $args)
    {
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
}
