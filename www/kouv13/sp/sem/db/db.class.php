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

    public function addReservation($idUser, $idField, $idSport, $date, $time, $day, $price, $status)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `reservations` (`reservation_id`, `sport_id`, `field_id`, `user_id`, `date`, `time`, `day`, `status`, `price`, `status_change`, `created_at`) VALUES (NULL, :idSport, :idField, :idUser, :date, :time, :day, :status, :price, current_timestamp(), current_timestamp());");
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':idField', $idField);
            $stmt->bindParam(':idSport', $idSport);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':day', $day);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            $resId = $this->conn->lastInsertId();
            return $resId;
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
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

    public function addSport($name)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `sports` (`sport_id`, `name`) VALUES (NULL, :name);");
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            return true;
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

    public function getMyReservation($idUser, $idRes)
    {
        try {
            $stmt = $this->conn->prepare("SELECT *, sports.name as sport_name, fields.name as field_name FROM `reservations` INNER JOIN sports ON sports.sport_id = reservations.sport_id INNER JOIN fields ON fields.field_id = reservations.field_id  WHERE reservation_id = :idRes AND user_id = :idUser AND status = '1'");
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':idRes', $idRes);
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

    public function isFull($time, $date, $idField)
    {
        try {
            $stmt = $this->conn->prepare("SELECT *, users.name as name FROM `reservations` INNER JOIN users on users.user_id = reservations.user_id WHERE field_id = :idField AND time = :time AND date = :date AND (status = '1' OR status = '2')");
            $stmt->bindParam(':idField', $idField);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':date', $date);
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

    public function getTodayReservations()
    {
        $today = date('Y-m-d');
        try {
            $stmt = $this->conn->prepare("SELECT *, sports.name as sport, fields.name as field, users.name as user FROM `reservations` INNER JOIN sports ON sports.sport_id = reservations.sport_id INNER JOIN users ON users.user_id = reservations.user_id INNER JOIN fields ON fields.field_id = reservations.field_id WHERE date = :today AND (status = '1' OR status = '2') ORDER BY fields.name ASC, time ASC");
            $stmt->bindParam(':today', $today);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getLastTen()
    {
        try {
            $stmt = $this->conn->prepare("SELECT *, sports.name as sport, fields.name as field, users.name as user FROM `reservations` INNER JOIN sports ON sports.sport_id = reservations.sport_id INNER JOIN users ON users.user_id = reservations.user_id INNER JOIN fields ON fields.field_id = reservations.field_id WHERE (status = '1' OR status = '2') ORDER BY reservation_id DESC limit 15");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
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

    public function getReserved($m, $s, $idfield)
    {
        try {
            $stmt = $this->conn->prepare("SELECT reservations.user_id, date, time, day, status, users.name as name FROM `reservations` INNER JOIN users on users.user_id = reservations.user_id WHERE field_id = :idfield AND date >= :m AND date <= :s AND (status = '1' OR status = '2')");
            $stmt->bindParam(':idfield', $idfield);
            $stmt->bindParam(':m', $m);
            $stmt->bindParam(':s', $s);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chybaa tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getMyReservations($idUser)
    {
        $today = date('Y-m-d');
        try {
            $stmt = $this->conn->prepare("SELECT *, sports.name AS sport_name, fields.name AS field_name FROM `reservations` INNER JOIN sports ON sports.sport_id = reservations.sport_id INNER JOIN fields ON fields.field_id = reservations.field_id WHERE user_id = :iduser AND date >= :today AND (status = '1' OR status='2') ORDER BY date asc, time asc");
            $stmt->bindParam(':today', $today);
            $stmt->bindParam(':iduser', $idUser);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllSports()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `sports` ORDER BY name");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }






    public function cancelReservation($idReservation, $idUser)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE reservations set status = '5',  status_change = current_timestamp() WHERE reservation_id = :idRes AND user_id = :idUser");
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':idRes', $idReservation);
            $stmt->execute();
            return true;
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
