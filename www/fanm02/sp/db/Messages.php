<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class MessagesDB extends Database {

    public function getMessages($meal){
        $sql = 'SELECT * FROM sp_messages WHERE meal_id = :meal ORDER BY sent_at ASC';
        $statement = $this->prepare($sql);
        $statement->bindParam(':meal', $meal);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function find(){
        $sql = 'SELECT * FROM sp_messages';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create($data){
        array_push($data, currentDate());

        $sql = 'INSERT INTO sp_messages (meal_id, sender_id, receiver_id, content, sent_at) VALUES (?, ?, ?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function update($query, $data){
        $sql = 'UPDATE sp_messages SET ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function delete($query){
        $sql = 'DELETE FROM sp_messages WHERE ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function findAll(){
        $sql = 'SELECT * FROM sp_messages';
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