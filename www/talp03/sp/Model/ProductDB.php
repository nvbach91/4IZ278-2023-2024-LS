<?php

require_once 'Database.php';

class ProductDB extends Database {
    
    public function findAll() {
        $statement = $this->pdo->prepare('SELECT * FROM products');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkLastUpdate($productId) {
        $statement = $this->pdo->prepare('SELECT last_updated FROM products WHERE product_id = :product_id');
        $statement->bindValue(':product_id', $productId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduct($data, $lastUpdate) {
        $currentUpdate = $this->checkLastUpdate($data['product_id'])[0];
        if ($currentUpdate['last_updated'] == $lastUpdate) {
            $statement = $this->pdo->prepare('UPDATE products SET name = :name, description = :description, img = :img, price = :price, category_id = :category_id WHERE product_id = :product_id');
            $statement->bindValue(':name', $data['name']);
            $statement->bindValue(':description', $data['description']);
            $statement->bindValue(':img', $data['img']);
            $statement->bindValue(':price', $data['price']);
            $statement->bindValue(':category_id', $data['category_id']);
            $statement->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
            $statement->execute();
            return true;
        } else {
            return false;
        }
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
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findId($id) {
        $statement = $this->pdo->prepare('SELECT product_id FROM products WHERE product_id = :product_id');
        $statement->bindValue(':product_id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchItemsPage($offset, $displayItems) {
        $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY product_id DESC LIMIT :displayItems OFFSET :offset');
        $statement->bindValue(':displayItems', $displayItems, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchItemsPageByCategory($offset, $displayItems, $category) {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE category_id = :category_id ORDER BY product_id DESC LIMIT :displayItems OFFSET :offset');
        $statement->bindValue(':displayItems', $displayItems, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':category_id', $category, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProducts() {
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM products');
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function deleteProduct($productId) {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE product_id = :product_id');
        $statement->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $statement->execute();
    }
}

?>