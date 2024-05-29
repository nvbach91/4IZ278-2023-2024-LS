<?php
require_once __DIR__ . '/Database.php';

class UsersDatabase extends Database
{
    protected $tableName = 'User';
    protected $tableId = 'idUser';
    protected $userEmail = 'email';
    protected $userRole = 'role';
    protected $userAuth = 'authType';

    public function readAllUsers()
    {
        //return $this->readAll($this->tableProduct);
        return $this->readAll($this->tableName);
    }

    public function readUsersCountEmails($email)
    {
        $quoteString = "'";
        $emailString = strval($email);
        $string = $quoteString . $emailString . $quoteString;


        $sql = "SELECT COUNT($this->tableId) FROM $this->tableName WHERE $this->userEmail = :email";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':email', $string);
            $statement->execute();
            return (int) $statement->fetchColumn();
    }

    public function readUserByEmail($email){
        $column = $this->userEmail;
        $quoteString = "'";
        $emailString = strval($email);
        $string = $quoteString . $emailString . $quoteString;
        return $this->readAllByColumn($this->tableName, $column, $string);
    }

    public function readUserById($userId){
        $column = $this->tableId;
        return $this->readAllByColumn($this->tableName, $column, $userId);
    }

    public function readUserByIdRole($userId, $role){
        $sql = "SELECT * FROM $this->tableName WHERE $userId = :userId AND 'role' = :role";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':role', $role);
        $statement->execute();
        return $statement->fetchAll();
    }


    public function createUserLocal($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userPassword = 'password';

        $defaultRole = 1;
        try {
            $this->pdo->beginTransaction();


            $sql = "INSERT INTO $this->tableName ($this->userEmail, $userPassword, $this->userRole, $this->userAuth) VALUES (:email, :password, $defaultRole, 'local');";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $hashedPassword);
            $statement->execute();

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            // Rollback transaction if there is an error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($userId){

        $value = $userId;

        return $this->deleteAll($this->tableName, $this->tableId, $value);
    }
}
