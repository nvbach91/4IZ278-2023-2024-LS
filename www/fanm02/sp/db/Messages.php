<?php

require_once './utils/db.php';

class MessagesDB extends Database {

    public function getAllMessages($senderId){
        return ($this->runQuery('SELECT * FROM messages WHERE sender_id = ?', [$senderId]) ?? [])[0];
    }

    public function find(){
        return $this->runQuery('SELECT * FROM messages', []);
    }

    public function create($data){
        array_push($data, time());
        return $this->runQuery('INSERT INTO messages (meal_id, sender_id, content, sent_at) VALUES (?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE messages WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM messages WHERE ' . $query, []);
    }
}

?>