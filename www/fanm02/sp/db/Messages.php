<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class MessagesDB extends Database {

    public function getMessages($meal){
        return $this->runQuery('SELECT * FROM messages WHERE meal_id = ? ORDER BY sent_at ASC', [$meal]);
    }

    public function find(){
        return $this->runQuery('SELECT * FROM messages', []);
    }

    public function create($data){
        array_push($data, currentDate());
        return $this->runQuery('INSERT INTO messages (meal_id, sender_id, receiver_id, content, sent_at) VALUES (?, ?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE messages WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM messages WHERE ' . $query, []);
    }
}

?>