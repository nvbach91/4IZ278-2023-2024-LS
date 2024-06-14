<?php
require_once 'database.php';
class UsersDB extends Database
{

    function findUser($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $users = $statement->fetchAll();
        return count($users) > 0 ? $users[0] : null;
    }
    function createUser($user)
    {
        $sql = "INSERT INTO sp_users (email , password, privilege, isBanned) VALUES (:email, :password, :privilege, :isBanned)";
        $result = $this->runQuery($sql, [
            'email' => $user['email'],
            'password' => $user['password'],
            'privilege' => 1,
            'isBanned' => 0
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
        $statement = $this->pdo->prepare("SELECT * FROM sp_users");
        $statement->execute();
        return $statement->fetchAll();
    }

    function fetchRegularUsers()
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_users WHERE privilege = 1");
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
        $sql = "UPDATE sp_users SET privilege = :privilege WHERE email = :email";
        $result = $this->runQuery($sql, [
            'email' => $email,
            'privilege' => $privilege,
        ]);
        return $result !== false;
    }


    function banUser($user_id)
    {
        $sql = "UPDATE sp_users SET isBanned = 1 WHERE user_id = :user_id";
        $result = $this->runQuery($sql, ['user_id' => $user_id]);
        return $result !== false;
    }

    function unbanUser($user_id)
    {
        $sql = "UPDATE sp_users SET isBanned = 0 WHERE user_id = :user_id";
        $result = $this->runQuery($sql, ['user_id' => $user_id]);
        return $result !== false;
    }
    function findUserByGithubId($githubId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_users WHERE github_id = :github_id");
        $statement->execute(['github_id' => $githubId]);
        $users = $statement->fetchAll();
        return count($users) > 0 ? $users[0] : null;
    }
    function createUserWithGithub($user)
    {
        $email = isset($user['email']) ? $user['email'] : 'default@example.com';
        $sql = "INSERT INTO sp_users (email, github_id, privilege, isBanned) VALUES (:email, :github_id, :privilege, :isBanned)";
        $result = $this->runQuery($sql, [
            'email' => $email,
            'github_id' => $user['id'],
            'privilege' => 1,
            'isBanned' => 0
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
