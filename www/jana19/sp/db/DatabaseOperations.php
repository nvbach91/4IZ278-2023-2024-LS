<?php 
interface DatabaseOperations
{
    // CRUD
    // zavolat funkce z Database.php
    public function readAll($tableName);

    // Pro table Product
    public function readAllProductTypes();
    public function readProductsByType($idProductType);
}
?>