<?php
require_once 'database.php';
class ItemsDB extends Database
{
    public function create($data)
    {
        $sql = "INSERT INTO sp_items (name, price, description, img) VALUES (:name, :price, :description, :img)";
        $this->runQuery($sql, [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'img' => $data['img']
        ]);
    }

    public function find($conditions)
    {
        $sql = "SELECT * FROM sp_items WHERE ";
        $sql .= implode(' AND ', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($conditions)));
        $result = $this->runQuery($sql, $conditions);
        return $result ? $result[0] : false;
    }

    public function findByCategory($category_id)
    {
        $sql = "SELECT * FROM sp_items WHERE category_id = :category_id";
        return $this->runQuery($sql, ['category_id' => $category_id]);
    }

    public function findAll($itemsPerPage = null, $offset = null)
    {
        $sql = "SELECT * FROM sp_items";
        if ($itemsPerPage !== null && $offset !== null) {
            $sql .= " LIMIT :itemsPerPage OFFSET :offset";
            return $this->runQuery($sql, ['itemsPerPage' => $itemsPerPage, 'offset' => $offset]);
        }
        return $this->runQuery($sql, []);
    }

    public function getTotalCount()
    {
        $sql = "SELECT COUNT(*) FROM cv08_goods";
        $result = $this->runQuery($sql, []);
        return $result[0]['COUNT(*)'];
    }

    public function update($query, $data)
    {
        echo 'GoodsDB called method update' . PHP_EOL;
        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }
        $stmt->execute();
    }

    public function delete($good_id)
    {
        $sql = "DELETE FROM cv08_goods WHERE good_id = :good_id";
        $this->runQuery($sql, ['good_id' => $good_id]);
    }
}
