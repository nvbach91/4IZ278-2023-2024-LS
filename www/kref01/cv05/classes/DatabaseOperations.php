<?php
interface DatabaseOperations {
    public function create($data);
    public function find($data);
    public function update($data);
    public function delete($data);
}
?>