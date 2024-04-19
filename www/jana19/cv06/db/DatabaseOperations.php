<?php 
interface DatabaseOperations
{
    // CRUD
    public function create($columns);
    public function find();
    public function findWhere($field, $value);
    public function updateWhere($conditions, $columns);
    public function deleteWhere($field, $value);
}
?>