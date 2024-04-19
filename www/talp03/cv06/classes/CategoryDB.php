<?php

require_once './utils/database.php';

class CategoryDB extends Database {
    public function find() {
        $query = "SELECT * FROM categories;";
        return $this->runQuery($query, []);
    }
}

?>