<?php

require_once './utils/db.php';

class DormsDB extends Database {

    public function find(){
        return $this->runQuery('SELECT * FROM dorms', []);
    }

    public function create($data){
        return $this->runQuery('INSERT INTO dorms (name, school, address) VALUES (?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE dorms WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM dorms WHERE ' . $query, []);
    }

    public function getDormitory($id){
        $result =  ($this->runQuery('SELECT * FROM dorms WHERE id = ?', [$id]));
        return ($result ? $result[0] : null);
    }
}

?>