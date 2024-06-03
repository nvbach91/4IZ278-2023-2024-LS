<?php

require_once 'Database.php';

class CategoryDB extends Database {
    
    public function findAll() {
        $statement = $this->pdo->prepare('SELECT * FROM category');
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>