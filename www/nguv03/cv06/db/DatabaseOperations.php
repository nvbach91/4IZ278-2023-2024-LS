<?php 

interface DatabaseOperations {
    public function create($args);
    public function find();
    public function findBy($field, $value);
    public function updateBy($conditions, $args);
    public function deleteBy($field, $value);
    // other operations CRUD
}

?>