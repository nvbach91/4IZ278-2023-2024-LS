<?php

require_once './utils/database.php';

class ProductDB extends Database {
    
    public function find() {
        return $this->runQuery(
            'SELECT * FROM cv08_goods',
            []
        );
    }

    public function select($itemId) {
        $statement = $this->pdo->prepare('SELECT * FROM cv08_goods WHERE good_id = :good_id');
        $statement->bindParam(':good_id', $itemId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($data, $itemId) {
        $statement = $this->pdo->prepare('UPDATE cv08_goods SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :good_id');
        $statement->bindValue(':name', $data['name']);
        $statement->bindValue(':price', $data['price']);
        $statement->bindValue(':description', $data['description']);
        $statement->bindValue(':img', $data['img']);
        $statement->bindValue(':good_id', $itemId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($itemId) {
        $statement = $this->pdo->prepare('DELETE FROM cv08_goods WHERE good_id = :good_id');
        $statement->bindParam(':good_id', $itemId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function create($data) {
        $statement = $this->pdo->prepare('INSERT INTO cv08_goods (name, price, description, img) VALUES (:name, :price, :description, :img)');
        $statement->bindValue(':name', $data['name']);
        $statement->bindValue(':price', $data['price']);
        $statement->bindValue(':description', $data['description']);
        $statement->bindValue(':img', $data['img']);
        $statement->execute();
    }

    public function fetchItemsPage($offset, $displayItems) {
        $statement = $this->pdo->prepare('SELECT * FROM cv08_goods ORDER BY good_id DESC LIMIT :displayItems OFFSET :offset');
        $statement->bindValue( ':displayItems', $displayItems, PDO::PARAM_INT);
        $statement->bindValue( ':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $countPerPage = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $countPerPage;
    }
}

?>