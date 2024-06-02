<?php

require_once 'DatabaseConnection.php';

abstract class Database {
    protected $pdo;

    public function __construct() {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    
    protected function runQuery($sql, $data) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $statement->fetchAll();
    }

    public function find($table, $column, $data) {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $column . ' = :data');
        $statement->bindValue(':data', $data, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function create($data){
        return '';
    }

    public function update($query, $data){
        return '';
    }

    public function delete($query){
        return '';
    }
}

?>