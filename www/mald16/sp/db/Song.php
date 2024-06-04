<?php

require_once "./db/db.php";
session_status() === PHP_SESSION_NONE ? session_start() : null;

class Song {
    public $songId;
    public $name;
    public $producer;
    public $orgId;
    public $client;
    public $date;

    public function __construct($songId) {
        global $db;

        $stmt = $db->prepare("SELECT * FROM songs WHERE song_id = :song_id");
        $stmt->bindValue(":song_id", $songId, PDO::PARAM_INT);
        $stmt->execute();

        $song = $stmt->fetch();

        $this->songId = $song ? $song["song_id"] : null;
        $this->name = $song ? $song["name"] : null;
        $this->producer = $song ? $song["producer"] : null;
        $this->orgId = $song ? $song["org_id"] : null;
        $this->client = $song ? $song["client"] : null;
        $this->date = $song ? $song["date"] : null;
    }

    public function getSong() {
        global $db;

        $stmt = $db->prepare("SELECT * FROM songs WHERE song_id = :song_id");
        $stmt->bindValue(":song_id", $this->songId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getOwnerEmail() {
        global $db;

        $stmt = $db->prepare("
            SELECT u.email 
            FROM songs s
            JOIN org_users ou ON s.client = ou.org_user_id
            JOIN users u ON ou.email = u.email
            WHERE s.song_id = :song_id
        ");
        $stmt->bindValue(":song_id", $this->songId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch()["email"];
    }



    public function getServices() {
        global $db;

        $stmt = $db->prepare("
            SELECT ss.*, os.service_name 
            FROM song_services ss
            JOIN org_services os ON ss.org_service_id = os.service_id
            WHERE ss.song_id = :song_id
        ");
        $stmt->bindValue(":song_id", $this->songId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public static function createSong($name, $producer = null, $client, $services, $orgId) {
        global $db;

        try {
            $db->beginTransaction();

            if ($producer != null) {
                $stmt = $db->prepare("INSERT INTO songs (name, producer, org_id, client, date) VALUES (:name, :producer, :org_id, :client, :date)");
                $stmt->bindValue(":producer", $producer, PDO::PARAM_INT);
            } else {
                $stmt = $db->prepare("INSERT INTO songs (name, org_id, client, date) VALUES (:name, :org_id, :client, :date)");
            }
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":org_id", $orgId, PDO::PARAM_INT);
            $stmt->bindValue(":client", $client, PDO::PARAM_INT);
            $stmt->bindValue(":date", date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $stmt->execute();

            $songId = $db->lastInsertId();

            foreach ($services as $serv) {
                $cleanServ = htmlspecialchars(trim($serv));
                $stmt = $db->prepare("INSERT INTO song_services (song_id, org_service_id, state) VALUES (:song_id, :org_service_id, :state)");
                $stmt->bindValue(":song_id", $songId, PDO::PARAM_INT);
                $stmt->bindValue(":org_service_id", $cleanServ, PDO::PARAM_INT);
                $stmt->bindValue(":state", 0, PDO::PARAM_INT);
                $stmt->execute();
            }
            $db->commit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $_SESSION["em"] = 12;
            header('Location: ' . "./index.php");
            exit();
        }

        $_SESSION["sm"] = 8;
        header('Location: ' . "./index.php");
        exit();
    }

    public static function editSong($name, $producer, $client, $servicesStatuses, $sid) {
        global $db;

        $stmt = $db->prepare("UPDATE songs SET name = :name, producer = :producer, client = :client WHERE song_id = :sid");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":producer", $producer, PDO::PARAM_STR);
        $stmt->bindValue(":client", $client, is_null($client) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(":sid", $sid, PDO::PARAM_INT);
        $songSuccess = $stmt->execute();

        $stmt = $db->prepare("DELETE FROM song_services WHERE song_id = :sid");
        $stmt->bindValue(":sid", $sid, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($servicesStatuses as $serviceId => $status) {
            $finishDate = date('Y-m-d');
            $stmt = $db->prepare("INSERT INTO song_services (song_id, org_service_id, state, finish_date) VALUES (:sid, :org_service_id, :state, :finish_date)");
            $stmt->bindValue(":sid", $sid, PDO::PARAM_INT);
            $stmt->bindValue(":org_service_id", $serviceId, PDO::PARAM_INT);
            $stmt->bindValue(":state", $status, PDO::PARAM_INT);
            $stmt->bindValue(":finish_date", $finishDate, PDO::PARAM_STR);
            $songServSuccess = $stmt->execute();
        }

        if ($songSuccess && $songServSuccess) {
            $_SESSION["sm"] = 9;
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    }



    public function deleteSong($sid) {
        global $db;

        $db->beginTransaction();

        $deleteDependents = $db->prepare("DELETE FROM song_services WHERE song_id = :song_id");
        $deleteDependents->bindValue(':song_id', $sid, PDO::PARAM_INT);
        $deleteDependents->execute();

        $deleteSong = $db->prepare("DELETE FROM songs WHERE song_id = :song_id");
        $deleteSong->bindValue(':song_id', $sid, PDO::PARAM_INT);
        $deleteSong->execute();

        return $db->commit();
    }
}
