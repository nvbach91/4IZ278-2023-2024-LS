<?php
require_once './classes/Database.php';

// TODO like in UserDB.php

class ParenthoodDB extends Database {
    public function create($data) {
        echo "create -$data- [ParenthoodDB] <br>";
    }

    public function find($data) {
        echo "find -$data- [ParenthoodDB] <br>";
    }

    public function update($data) {
        echo "update -$data- [ParenthoodDB] <br>";
    }

    public function delete($data) {
        echo "delete -$data- [ParenthoodDB] <br>";
    }
}
?>