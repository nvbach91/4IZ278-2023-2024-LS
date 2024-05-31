<?php 
interface DatabaseOperations
{
    // CRUD
    // zavolat funkce z Database.php
    public function readAll($tableName);
    public function readAllByColumn($tableName, $column, $value);
    public function readCountAll($tableName, $tableId);

    public function deleteAll($tableName, $tableId, $value);

    
    
}
?>