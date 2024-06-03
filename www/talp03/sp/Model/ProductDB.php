<?php

require_once 'Database.php';

class ProductDB extends Database {
    
    public function findAll() {
        $statement = $this->pdo->prepare('SELECT * FROM products');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateProduct($data) {
        $statement = $this->pdo->prepare('UPDATE products SET name = :name, description = :description, img = :img, price = :price, category_id = :category_id WHERE product_id = :product_id');
        $statement->bindValue(':name', $data['name']);
        $statement->bindValue(':description', $data['description']);
        $statement->bindValue(':img', $data['img']);
        $statement->bindValue(':price', $data['price']);
        $statement->bindValue(':category_id', $data['category_id']);
        $statement->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function createNewProduct($data) {
        $statement = $this->pdo->prepare('INSERT INTO products(name, description, img, price, category_id) VALUES (:name, :description, :img, :price, :category_id)');
        $statement->bindValue(':name', $data['name']);
        $statement->bindValue(':description', $data['description']);
        $statement->bindValue(':img', $data['img']);
        $statement->bindValue(':price', $data['price']);
        $statement->bindValue(':category_id', $data['category_id']);
        $statement->execute();
    }

    public function findByCategory($category) {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE category_id = :category_id');
        $statement->bindValue(':category_id', $category, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findId($id) {
        $statement = $this->pdo->prepare('SELECT product_id FROM products WHERE product_id = :product_id');
        $statement->bindValue(':product_id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getPriceSum($question_marks) {
        $statement = $this->pdo->prepare("SELECT SUM(price) FROM products WHERE product_id IN ($question_marks)");
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>