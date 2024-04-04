<?php 
interface DatabaseOperations
{
    // zde bude CRUD
    public function create($data);
    public function find($query);
    public function findAll($query);
    public function update($query, $data);
    public function delete($query);
}
?>