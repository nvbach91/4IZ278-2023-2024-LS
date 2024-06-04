<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class MessagesDB extends Database {

    public function getMessages($meal){
        return $this->runQuery('SELECT * FROM sp_messages WHERE meal_id = ? ORDER BY sent_at ASC', [$meal]);
    }

    public function find(){
        return $this->runQuery('SELECT * FROM sp_messages', []);
    }

    public function create($data){
        array_push($data, currentDate());
        return $this->runQuery('INSERT INTO sp_messages (meal_id, sender_id, receiver_id, content, sent_at) VALUES (?, ?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE sp_messages WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM sp_messages WHERE ' . $query, []);
    }

    public function findAll(){
        return $this->runQuery('SELECT * FROM sp_messages', []);
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>