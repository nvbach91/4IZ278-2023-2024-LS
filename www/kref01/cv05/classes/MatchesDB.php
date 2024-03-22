<?php
require_once './classes/Database.php';

class MatchesDB extends Database {
    public function create($data) {
        echo "create -$data- [MatchesDB]\n";
    }

    public function find($data) {
        echo "find -$data- [MatchesDB]\n";
    }

    public function update($data) {
        echo "update -$data- [MatchesDB]\n";
    }

    public function delete($data) {
        echo "delete -$data- [MatchesDB]\n";
    }
}
?>