<?php

require_once "Database.php";

class ProductsDB extends Database
{
    public function create($data)
    {
        return $this->runQuery('INSERT INTO cv08_goods (name, price, description, img) VALUES (:name, :price, :description, :img);', [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'img' => $data['img']
        ]);
    }

    public function find($query)
    {
        return $this->runQuery('SELECT * FROM cv08_goods WHERE good_id = :product_id;', [
            'product_id' => $query['product_id']
        ])->fetch();
    }

    public function findAll()
    {
        return $this->runQuery('SELECT * FROM cv08_goods;', [])->fetchAll();
    }

    public function findAllPaginated($limit, $offset)
    {
        $statement = $this->pdo->prepare('SELECT * FROM cv08_goods ORDER BY good_id DESC LIMIT :limit OFFSET :offset;');
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCount()
    {
        $statement = $this->runQuery('SELECT COUNT(*) FROM cv08_goods;', []);
        return $statement->fetchColumn();
    }

    public function exists($query)
    {
        $result = $this->runQuery('SELECT EXISTS (SELECT 1 FROM cv08_goods WHERE good_id = :product_id) AS ProductExists', [
            'product_id' => $query['product_id']
        ])->fetch();

        return $result['ProductExists'];
    }

    public function update($query, $data)
    {
        return $this->runQuery('UPDATE cv08_goods SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :product_id;', [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'img' => $data['img'],
            'product_id' => $query['product_id']
        ]);
    }

    public function delete($query)
    {
        return $this->runQuery('DELETE FROM cv08_goods WHERE good_id = :product_id;', [
            'product_id' => $query['product_id']
        ]);
    }
}
