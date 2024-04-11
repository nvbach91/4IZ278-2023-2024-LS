<?php
require_once 'database.php';
class CategoriesDB extends Database {
    public function findAll() {
        $sql = "SELECT * FROM cv06_categories";
        return $this->runQuery($sql, []);
    }
    public function create($data) {
        // Implement the create method
    }

    public function find($query = []) {
        //implement the find method
    }

    public function update($query, $data) {
        // Implement the update method
    }

    public function delete($query) {
        // Implement the delete method
    }

}
?>