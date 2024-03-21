<?php
class PlayersDB extends Database {
    public function create($data) {
        echo "create -$data- [PlayersDB]\n";
    }

    public function find($data) {
        echo "find -$data- [PlayersDB]\n";
    }

    public function update($data) {
        echo "update -$data- [PlayersDB]\n";
    }

    public function delete($data) {
        echo "delete -$data- [PlayersDB]\n";
    }
}
?>