<?php

class Field
{
    private $conn;

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

    public function addField($name, $desc, $capacity, $price, $imgName)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `fields` (`field_id`, `name`, `description`, `capacity`, `price`, `img`) VALUES (NULL, :name, :desc, :capacity, :price, :img);");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':capacity', $capacity);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':img', $imgName);
            $stmt->execute();
            $id = $this->conn->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getField($idfield)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `fields` WHERE field_id = :idfield");
            $stmt->bindParam(':idfield', $idfield);
            $stmt->execute();
            return $stmt->fetchObject();
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getFields()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `fields` ORDER BY name ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function editField($name, $desc, $capacity, $price, $idField)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE fields set name = :name, description = :desc, capacity = :capacity, price = :price WHERE field_id = :idField");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':capacity', $capacity);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':idField', $idField);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteField($idField)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM fields WHERE field_id = :idField");
            $stmt->bindParam(':idField', $idField);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }



}
