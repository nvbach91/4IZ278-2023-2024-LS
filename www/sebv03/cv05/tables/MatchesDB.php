<?php
class MatchesDB extends Database
{
    public function create($data) {
        echo "MatchesDB create() called.";
    }
    public function find($query) {
        echo "MatchesDB find() called.";
    }
    public function update($query, $data) {
        echo "MatchesDB update() called.";
    }
    public function delete($query) {
        echo "MatchesDB delete() called.";
    }
}
?>