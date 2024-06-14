<?php

class User
{
    public $conn;

    public function __construct()
    {
        require "cr.php";
        $dsn = "mysql:host=localhost;dbname=$dbname;port=3306";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo "Nelze se připojit k MySQL: ";
            echo $e->getMessage();
        }
    }


    public function addUser($email, $name, $password)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`) VALUES (NULL, :name, :email, :password, current_timestamp());");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $userId = $this->conn->lastInsertId();
            return $userId;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getUser($email)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchObject();
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getPasswordHash($email)
    {
        try {
            $stmt = $this->conn->prepare("SELECT password FROM `users` WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchObject();
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function changePassword($password, $idUser)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users set password = :password WHERE user_id = :idUser");
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }
}
