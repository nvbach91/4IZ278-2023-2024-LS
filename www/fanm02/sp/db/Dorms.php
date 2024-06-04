<?php

require_once './utils/db.php';

class DormsDB extends Database {

    public function find(){
        $sql = 'SELECT * FROM sp_dorms';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create($data){
        $sql = 'INSERT INTO sp_dorms (name, school, address) VALUES (?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function update($query, $data){
        $sql = 'UPDATE sp_dorms SET ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function delete($query){
        $sql = 'DELETE FROM sp_dorms WHERE ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function getDormitory($id){
        $sql = 'SELECT * FROM sp_dorms WHERE id = :id';
        $statement = $this->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch();
    }

    public function findAll(){
        $sql = 'SELECT * FROM sp_dorms';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>