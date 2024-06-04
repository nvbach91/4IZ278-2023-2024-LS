<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class UsersDB extends Database {

    public function getUser($username, $email){
        $result = $this->runQuery('SELECT * FROM sp_users WHERE username = ? OR email = ?', [$username, $email]);
        return ($result ? $result[0] : null);
    }

    public function getUserByMeal($meal){
        $result = $this->runQuery('SELECT * FROM sp_users WHERE id = (SELECT chef_id FROM sp_meals WHERE id = ?)', [$meal]);
        return ($result ? $result[0] : null);
    }

    public function find(){
        return $this->runQuery('SELECT * FROM sp_users', []);
    }

    public function create($data){
        array_push($data, currentDate());
        return $this->runQuery('INSERT INTO sp_users (username, email, passwordHash, created_at) VALUES (?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE sp_users WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM sp_users WHERE ' . $query, []);
    }

    public function createOAuth($data){
        array_push($data, time());
        return $this->runQuery('INSERT INTO sp_users (username, email, created_at) VALUES (?, ?, ?)', $data);
    }

    public function updatePassword($email, $passwordHash){
        return $this->runQuery('UPDATE sp_users SET passwordHash = ? WHERE email = ?', [$passwordHash, $email]);
    }

    public function updateUsername($username, $oldUsername){
        return $this->runQuery('UPDATE sp_users SET username = ? WHERE username = ?', [$username, $oldUsername]);
    }

    public function updatePhoto($username, $photo){
        return $this->runQuery('UPDATE sp_users SET photo_url = ? WHERE username = ?', [$photo, $username]);
    }

    public function updateDormitory($username, $dorm){
        return $this->runQuery('UPDATE sp_users SET dorm_id = ? WHERE username = ?', [$dorm, $username]);
    }

    public function findAll(){
        return $this->runQuery('SELECT * FROM sp_users', []);
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>