<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class UsersDB extends Database {

    public function getUser($username, $email){
        $sql = 'SELECT * FROM sp_users WHERE username = :username OR email = :email';
        $statement = $this->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->execute();

        return $statement->fetch();
    }

    public function getUserByMeal($meal){
        $sql = 'SELECT * FROM sp_users WHERE id = (SELECT chef_id FROM sp_meals WHERE id = :meal)';
        $statement = $this->prepare($sql);
        $statement->bindParam(':meal', $meal);
        $statement->execute();

        return $statement->fetch();
    }

    public function find(){
        $sql = 'SELECT * FROM sp_users';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create($data){
        array_push($data, currentDate());

        $sql = 'INSERT INTO sp_users (username, email, passwordHash, created_at) VALUES (?, ?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function update($query, $data){
        $sql = 'UPDATE sp_users SET ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function delete($query){
        $sql = 'DELETE FROM sp_users WHERE ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function createOAuth($data){
        array_push($data, currentDate());

        $sql = 'INSERT INTO sp_users (username, email, created_at) VALUES (?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function updatePassword($email, $passwordHash){
        $sql = 'UPDATE sp_users SET passwordHash = :passwordHash WHERE email = :email';
        $statement = $this->prepare($sql);
        $statement->bindParam(':passwordHash', $passwordHash);
        $statement->bindParam(':email', $email);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function updateUsername($username, $oldUsername){
        $sql = 'UPDATE sp_users SET username = :username WHERE username = :oldUsername';
        $statement = $this->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':oldUsername', $oldUsername);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function updatePhoto($username, $photo){
        $sql = 'UPDATE sp_users SET photo_url = :photo WHERE username = :username';
        $statement = $this->prepare($sql);
        $statement->bindParam(':photo', $photo);
        $statement->bindParam(':username', $username);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function updateDormitory($username, $dorm){
        $sql = 'UPDATE sp_users SET dorm_id = :dorm WHERE username = :username';
        $statement = $this->prepare($sql);
        $statement->bindParam(':dorm', $dorm);
        $statement->bindParam(':username', $username);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function findAll(){
        $sql = 'SELECT * FROM sp_users';
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