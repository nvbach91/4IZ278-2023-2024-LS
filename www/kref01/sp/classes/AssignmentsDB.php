<?php
require_once './classes/Database.php';

// TODO like in UserDB.php

class AssignmentsDB extends Database {
    public function create($data) {
        echo "create -$data- [AssignmentsDB] <br>";
    }

    public function find($data) {
        echo "find -$data- [AssignmentsDB] <br>";
    }

    public function update($data) {
        echo "update -$data- [AssignmentsDB] <br>";
    }

    public function delete($data) {
        echo "delete -$data- [AssignmentsDB] <br>";
    }
}
?>