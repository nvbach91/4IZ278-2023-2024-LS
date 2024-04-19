<?php
require_once __DIR__ . '/Database.php';

class ProductDB extends Database
{
    protected $tableName = 'cv08_goods';

    public function countAllProducts()
    {
        # celkovy pocet zbozi pro strankovani
        $count = $this->pdo->query("SELECT COUNT(good_id) FROM cv08_goods;")->fetchColumn();
        return $count;
    }
    public function findItemsPage($offset, $nItemsPerPagination)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cv08_goods ORDER BY good_id DESC LIMIT $nItemsPerPagination OFFSET ?;");
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findItemsByID()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cv08_goods WHERE good_id = :id;");
        $stmt->execute(['id' => $_GET['id']]);
        $goods = $stmt->fetch();
        if (!$goods) {
            exit("Unable to find goods!");
        }
    }

    public function findGoodsForCart() {
        $goodsCart = [];
        $ids = @$_SESSION['cart'];
        if (is_array($ids) && count($ids)) {
            # retezec s otazniky pro predani seznamu ids
            # pocet otazniku = pocet prvku v poli ids
            # pokud mam treba v ids 1,2,3, vrati mi ?,?,?
            $question_marks = str_repeat('?,', count($ids) - 1) . '?';
            
            $stmt = $this->pdo->prepare("SELECT * FROM cv08_goods WHERE good_id IN ($question_marks) ORDER BY name;");
            # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
            $stmt->execute(array_values($ids));
            $goodsCart = $stmt->fetchAll();
        }
    }

    public function findColumnsForCart() {
        $goods = [];
        $ids = @$_SESSION['cart'];
        if (is_array($ids) && count($ids)) {
            # retezec s otazniky pro predani seznamu ids
            # pocet otazniku = pocet prvku v poli ids
            # pokud mam treba v ids 1,2,3, vrati mi ?,?,?
            $question_marks = str_repeat('?,', count($ids) - 1) . '?';
            
            $stmt_sum = $this->pdo->prepare("SELECT SUM(price) FROM cv08_goods WHERE good_id IN ($question_marks);");
            # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
            $stmt_sum->execute(array_values($ids));
            $columnsCart = $stmt_sum->fetchColumn();
        }
    }



    public function create($s)
    {
        $sql = "INSERT INTO cv06_products(name, price, img) VALUES (:name, :price, :img);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $columns['name'],
            'price' => $columns['price'],
            'img' => $columns['img'],
        ]);
    }
}
