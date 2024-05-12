<?php
require_once './classes/Database.php';

// TODO like in UserDB.php

class HomeworksDB extends Database {
    public function create($data) {
        echo "create -$data- [HomeworksDB] <br>";
    }

    public function find($data) {
        echo "find -$data- [HomeworksDB] <br>";
    }

    public function update($data) {
        echo "update -$data- [HomeworksDB] <br>";
    }

    public function delete($data) {
        echo "delete -$data- [HomeworksDB] <br>";
    }
}
?>