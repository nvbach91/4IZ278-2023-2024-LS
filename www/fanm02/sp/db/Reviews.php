<?php

require_once './utils/db.php';

class ReviewsDB extends Database {

    public function getReviews($reviewee){
        return ($this->runQuery('SELECT * FROM reviews WHERE reviewee_id = ?', [$reviewee]) ?? [])[0];
    }

    public function find(){
        return $this->runQuery('SELECT * FROM reviews', []);
    }

    public function create($data){
        array_push($data, time());
        array_push($data, time());
        return $this->runQuery('INSERT INTO reviews (reviewer_id, reviewee_id, text, rating, updated_at, created_at) VALUES (?, ?, ?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE reviews WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM reviews WHERE ' . $query, []);
    }
}

?>