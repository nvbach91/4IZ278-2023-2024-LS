<?php
require_once 'database.php';
class ItemsDB extends Database
{

public function create($data)
{
    $sql = "INSERT INTO sp_items (name, image, strength, dexterity, hitpoints, luck, equipment_type, price_to_buy, price_to_sell) VALUES (:name, :image, :strength, :dexterity, :hitpoints, :luck, :equipment_type, :price_to_buy, :price_to_sell)";
    $this->runQuery($sql, [
        'name' => $data['name'],
        'image' => $data['image'],
        'strength' => $data['strength'],
        'dexterity' => $data['dexterity'],
        'hitpoints' => $data['hitpoints'],
        'luck' => $data['luck'],
        'equipment_type' => $data['equipment_type'],
        'price_to_buy' => $data['price_to_buy'],
        'price_to_sell' => $data['price_to_sell']
    ]);
}


    public function getRandomItems($limit = 6)
    {
        $sql = "SELECT * FROM sp_items ORDER BY RAND() LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findByName($name)
    {
        $sql = "SELECT * FROM sp_items WHERE name = :name";
        $result = $this->runQuery($sql, ['name' => $name]);
        return $result ? $result[0] : false;
    }
    public function getItem($item_id)
    {
        $sql = "SELECT * FROM sp_items WHERE item_id = :item_id";
        $result = $this->runQuery($sql, ['item_id' => $item_id]);
        return $result ? $result[0] : false;
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
public function getItemDetails($itemId) {
    $conditions = ['item_id' => $itemId];
    return $this->find($conditions);
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
        $sql = "SELECT COUNT(*) FROM sp_items";
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
