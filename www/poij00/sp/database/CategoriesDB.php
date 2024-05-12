<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class CategoriesDB extends Database {
    protected $tableName = 'categories';
    public function create($data) {
        $sql = "INSERT INTO $this->tableName (name) VALUES (:name)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['name' => $data['name']]);
    }
}

?>