<?php
require_once __DIR__ .'/Database.php';


class SlidesDB extends Database {
    protected $tableName = 'cv06_slides';
    public function create($columns) {
        $sql = "INSERT INTO $this->tableName (img, title) VALUES (:img, :title);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $columns['name'],
            'title' => $columns['title'],
        ]);
    }
}

?>
