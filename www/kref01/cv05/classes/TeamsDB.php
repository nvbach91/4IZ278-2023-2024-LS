<?php
require_once './classes/Database.php';

class TeamsDB extends Database {
    public function create($data) {
        echo "create -$data- [TeamsDB]\n";
    }

    public function find($data) {
        echo "find -$data- [TeamsDB]\n";
    }

    public function update($data) {
        echo "update -$data- [TeamsDB]\n";
    }

    public function delete($data) {
        echo "delete -$data- [TeamsDB]\n";
    }
}
?>