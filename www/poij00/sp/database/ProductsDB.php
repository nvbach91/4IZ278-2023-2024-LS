<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class ProductsDB extends Database {
    protected $tableName = 'products';

    public function selectAll () {
        $sql = "SELECT count(product_id) FROM $this->tableName";
        $statement = $this->pdo->query($sql);
        $result = $statement->fetchColumn();
        return $result;
    }

    public function pagination() {

        $nItemsPerPagination = 4;

        if (isset($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        } else {
            $offset = 0;
        }

        $sql = "SELECT * FROM $this->tableName ORDER BY product_id DESC LIMIT $nItemsPerPagination OFFSET ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function paginationByCategory($category_id) {

        $nItemsPerPagination = 4;

        if (isset($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        } else {
            $offset = 0;
        }

        $sql = "SELECT * FROM $this->tableName WHERE category_id = $category_id ORDER BY product_id DESC LIMIT $nItemsPerPagination OFFSET ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }


    public function findByCategory($category_id) {
        return $this->findBy('category_id', $category_id);
    }
    public function create($data) {
        $sql = "INSERT INTO $this->tableName (product_name, image, price, category_id) VALUES (:product_name, :image, :price, :category_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $data['product_name'], 
            'price' => $data['image'], 
            'img' => $data['price'],
            'description' => $data['description'],
            'category_id' => $data['category_id']

        ]);
    }
}

?>



