<?php
class db
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

    public function addSportField($idSport, $idField)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `field_sport` (`id`, `sport_id`, `field_id`) VALUES (NULL, :idSport, :idField);");
            $stmt->bindParam(':idSport', $idSport);
            $stmt->bindParam(':idField', $idField);
            $stmt->execute();
            $id = $this->conn->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }


    public function getStatusFieldSport($idSport, $idField)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id FROM `field_sport` WHERE sport_id = :idSport AND field_id = :idField");
            $stmt->bindParam(':idSport', $idSport);
            $stmt->bindParam(':idField', $idField);
            $stmt->execute();
            return $stmt->fetchObject();
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }


    public function getFieldSports($idfield)
    {
        try {
            $stmt = $this->conn->prepare("SELECT sports.sport_id, sports.name FROM `field_sport` INNER JOIN sports ON sports.sport_id = field_sport.sport_id WHERE field_sport.field_id = :idfield ORDER BY name ASC");
            $stmt->bindParam(':idfield', $idfield);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }
    public function deleteSportField($idSport, $idField)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM field_sport WHERE field_id = :idField AND sport_id = :idSport");
            $stmt->bindParam(':idSport', $idSport);
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
