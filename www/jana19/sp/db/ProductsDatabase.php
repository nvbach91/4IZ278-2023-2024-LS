<?php
require_once __DIR__ .'/Database.php';

class ProductsDatabase extends Database {
    protected $tableName = 'cv06_products';
   
    public function read()
    {
        $sql = "SELECT * FROM $this->tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>