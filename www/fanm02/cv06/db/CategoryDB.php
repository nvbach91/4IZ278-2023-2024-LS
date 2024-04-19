<?php

require_once 'utils/db.php';

class CategoriesDB extends Database {
    public function find() {
        
        $results = $this->runQuery("SELECT * FROM cv06_categories", []);
        return $results;
    }
}

?>