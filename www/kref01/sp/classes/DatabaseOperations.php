<?php
interface DatabaseOperations {
    public function create($data);
    public function find($id);
    public function update($data);
    public function delete($id);
}
?>