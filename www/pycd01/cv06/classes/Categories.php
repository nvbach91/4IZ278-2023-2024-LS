<?php
include_once './utils/db.php';
class Categories
{
    public function __construct(
        public string $name, 
        public int $category_id,
    ) { }
} 

class CategoriesDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'categories';
    }
    public function create($user) 
    {
    $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (name, category_id) VALUES (:name, :category_id)');
    $statement->bindParam(':name', $user->name);
    $statement->bindParam(':category_id', $user->category_id);
    $statement->execute();
    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($user, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET name = :name, category_id = :category_id WHERE id = :id');
        $statement->bindParam(':name', $user->name);
        $statement->bindParam(':category_id', $user->category_id);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
}