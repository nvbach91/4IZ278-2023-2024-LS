<?php

require_once './utils/database.php';

class UserDB extends Database {
    public function find($query)
    {
       return ''; 
    }
    public function create($data)
    {
        return '';
    }
    public function update($query, $data)
    {
        return '';
    }
    public function delete($query)
    {
        return '';
    }

    public function findAll() {
        $statement = $this->pdo->prepare('SELECT * FROM cv10_users');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function changePrivilege($user_id, $privilege) {
        $statement = $this->pdo->prepare('UPDATE cv10_users SET privilege = :privilege WHERE user_id = :user_id');
        $statement->bindValue('privilege', $privilege, PDO::PARAM_INT);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
    }
}

?>