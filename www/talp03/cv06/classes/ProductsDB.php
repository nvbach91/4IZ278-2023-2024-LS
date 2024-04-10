
<?php
require_once './utils/database.php';

class ProductsDB extends Database { 
    /*public function create($data) {
        return $this->runQuery(
            'INSERT INTO products(name) VALUES (:name);',
            ['name' => $data['name']]
        );
    }*/
    public function find() {
        return $this->runQuery(
            'SELECT * FROM products',
            []
        );
    }

    public function findByCategory($category_id) {
        return $this->runQuery(
            'SELECT * FROM products WHERE category_id LIKE :category',
            ['category' => $category_id]
        );
    }
    /*public function findAll() {
        return $this->runQuery(
            'SELECT * FROM products;',
            []
        );
    }
    public function update($query, $data) {
        echo 'Players DB called method update';
    }
    public function delete($query) {
        return $this->runQuery(
            'DELETE FROM products WHERE name = :name;',
            ['name' => $query['name']]
        );
    }*/
}

?>