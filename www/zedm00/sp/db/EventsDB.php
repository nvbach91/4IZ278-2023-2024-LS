<?php

require_once __DIR__ . '/DB.php';
require_once './config/config.php';

class EventsDB extends DB
{

    public function getEvents($page = 1, $category_id = null)
    {
        if ($category_id === "all") $category_id = null;
        $limit = pageLimit;
        $offset = ($page - 1) * $limit;

        if ($category_id === null) {
            $query = "SELECT event.*, advertizer.name AS advertizer_name FROM event 
              JOIN advertizer ON event.advertizer_id = advertizer.id 
              ORDER BY time ASC LIMIT :limit OFFSET :offset";
        } else {
            $query = "SELECT event.*, advertizer.name AS advertizer_name FROM event 
              JOIN advertizer ON event.advertizer_id = advertizer.id 
              WHERE type = :category_id ORDER BY time ASC LIMIT :limit OFFSET :offset";
        }

        $statement = $this->db->prepare($query);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);

        if ($category_id !== null) {
            $statement->bindParam(':category_id', $category_id);
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAdvertizerEvents($id)
    {
        $query = "SELECT event.*, COUNT(CASE WHEN ticket.confirmed IS NOT NULL THEN 1 END) as tickets_sold 
          FROM event 
          LEFT JOIN ticket ON event.id = ticket.event_id 
          WHERE event.advertizer_id = :id 
          GROUP BY event.id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findEvent($event_id)
    {
        $query = "SELECT * FROM event WHERE id = :event_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':event_id', $event_id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }



    public function getEventsCount($category_id = null)
    {
        if ($category_id === "all") $category_id = null;

        if ($category_id === null) {
            $query = "SELECT COUNT(*) AS total FROM event";
        } else {
            $query = "SELECT COUNT(*) AS total FROM event WHERE type = :category_id";
        }

        $statement = $this->db->prepare($query);


        if ($category_id !== null) {
            $statement->bindParam(':category_id', $category_id);
        }

        $statement->execute();


        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function saveNewEvent($name, $time, $type, $price, $capacity, $advertizer_id, $description, $address, $picture)
    {
        $query = "INSERT INTO event (name, time, type, price, capacity, advertizer_id, description, address, picture) VALUES (:name, :time, :type, :price, :capacity, :advertizer_id, :description, :address, :picture)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':time', $time);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':capacity', $capacity);
        $statement->bindParam(':advertizer_id', $advertizer_id);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':picture', $picture);
        $statement->execute();
    }


    public function updateEvent($id, $name, $time, $type, $price, $capacity, $description, $address, $picture)
    {
        $query = "UPDATE event SET name = :name, time = :time, type = :type, price = :price, capacity = :capacity, description = :description, address = :address, picture = :picture WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':time', $time);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':capacity', $capacity);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':picture', $picture);
        $statement->execute();

    }


    public function cancelEvent($id)
    {
        $query = "UPDATE event SET cancelled = 1 WHERE id = :event_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':event_id', $id);
        $statement->execute();
        return $statement;
    }

    public function deleteEvent($event_id)
    {
        $query = "DELETE FROM event WHERE id = :event_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':event_id', $event_id);
        $statement->execute();
        return $statement;
    }








    public function statistics($advertizer_id)
    {
        $query = "SELECT
        e.id AS event_id,
        e.name AS event_name,
        COUNT(t.id) AS total_tickets_sold,
        SUM(e.price) AS total_sold_price
        FROM
            event e
        LEFT JOIN
            ticket t ON t.event_id = e.id
        WHERE e.advertizer_id = :advertizer_id
        GROUP BY e.name;";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':advertizer_id', $advertizer_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
