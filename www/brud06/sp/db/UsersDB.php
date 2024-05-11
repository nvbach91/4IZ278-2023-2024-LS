<?php
require_once 'database.php';
class UsersDB extends Database
{

    function findUser($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $users = $statement->fetchAll();
        return count($users) > 0 ? $users[0] : null;
    }
    function createUser($user)
    {
        $sql = "INSERT INTO cv10_users (email , password, privilege) VALUES (:email, :password, :privilege)";
        $result = $this->runQuery($sql, [
            'email' => $user['email'],
            'password' => $user['password'],
            'privilege' => 1,
        ]);
        return $result !== false;
    }
    function checkUser($email, $password)
    {
        $user = $this->findUser($email);
        if ($user['password'] == $password) {
            return $user;
        }
        return false;
    }
    function fetchAllUsers()
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_users");
        $statement->execute();
        return $statement->fetchAll();
    }
    function checkUserExist($email)
    {
        $user = $this->findUser($email);
        if ($user) {
            return true;
        }
        return false;
    }

    function setPrivilege($email, $privilege)
    {
        $sql = "UPDATE cv10_users SET privilege = :privilege WHERE email = :email";
        $result = $this->runQuery($sql, [
            'email' => $email,
            'privilege' => $privilege,
        ]);
        return $result !== false;
    }
    function create($attribute)
    {
        //empty
    }
    function update($attribute, $data)
    {
        //empty
    }
    function delete($attribute)
    {
        //empty
    }
    function find($attribute)
    {
        //empty
    }
}
