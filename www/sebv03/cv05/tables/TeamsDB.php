<?php
class TeamsDB extends Database
{
    public function create($data) {
        echo "TeamsDB create() called.";
    }
    public function find($query) {
        echo "TeamsDB find() called.";
    }
    public function update($query, $data) {
        echo "TeamsDB update() called.";
    }
    public function delete($query) {
        echo "TeamsDB delete() called.";
    }
}
?>