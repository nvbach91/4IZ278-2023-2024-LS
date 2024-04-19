<?php

require_once 'utils/db.php';

class SlidesDB extends Database {
    public function find() {

        $results = $this->runQuery("SELECT * FROM cv06_slides", []);
        return $results;
    }
}

?>