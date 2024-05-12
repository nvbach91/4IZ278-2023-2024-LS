<?php

require_once "./db/db.php";
session_status() === PHP_SESSION_NONE ? session_start() : null;

ini_set('display_errors', 1);
error_reporting(E_ALL);


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

    public function getServices() {
        global $db;

        $stmt = $db->prepare("SELECT * FROM song_services WHERE song_id = :song_id");
        $stmt->bindValue(":song_id", $this->songId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function createSong($name, $producer, $client, $services, $orgId) {
        global $db;

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("INSERT INTO songs (name, producer, org_id, client, date) VALUES (:name, :producer, :org_id, :client, :date)");
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":producer", $producer, PDO::PARAM_INT);
            $stmt->bindValue(":org_id", $orgId, PDO::PARAM_INT);
            $stmt->bindValue(":client", $client, is_null($client) ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $stmt->bindValue(":date", date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $stmt->execute();

            $songId = $db->lastInsertId();

            foreach ($services as $serv) {
                $stmt = $db->prepare("INSERT INTO song_services (song_id, org_service_id, state) VALUES (:song_id, :org_service_id, :state)");
                $stmt->bindValue(":song_id", $songId, PDO::PARAM_INT);
                $stmt->bindValue(":org_service_id", $serv, PDO::PARAM_INT);
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

    public static function editSong($name, $producer, $client, $services, $sid) {
        global $db;

        $stmt = $db->prepare("UPDATE songs SET name = :name, producer = :producer, client = :client WHERE song_id = :sid");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":producer", $producer, PDO::PARAM_STR);
        $stmt->bindValue(":client", $client, is_null($client) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(":sid", $sid, PDO::PARAM_INT);
        $songSuccess = $stmt->execute();

        $stmt = $db->prepare("DELETE FROM song_services WHERE song_id = :sid"); // vymazání všech služeb u skladby
        $stmt->bindValue(":sid", $_GET["sid"], PDO::PARAM_INT);
        $stmt->execute();

        foreach ($services as $serv) {
            //  přidání služeb znovu
            $stmt = $db->prepare("INSERT INTO song_services (song_id, org_service_id, state) VALUES (:sid, :org_service_id, :state)");
            $stmt->bindValue(":sid", $_GET["sid"], PDO::PARAM_INT);
            $stmt->bindValue(":org_service_id", $serv, PDO::PARAM_INT);
            $stmt->bindValue(":state", 0, PDO::PARAM_INT);
            $songServSuccess = $stmt->execute();
        }

        if ($songSuccess && $songServSuccess) {
            $_SESSION["sm"] = 9;
            header('Location: ' . "./index.php");
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
