<?php

require_once __DIR__ . '/DB.php';

class TicketsDB extends DB
{
    public function findTicketForUserEvent($event_id, $user_id)
    {
        $query = "SELECT * FROM ticket WHERE event_id = :event_id AND customer_id = :customer_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':event_id', $event_id);
        $statement->bindParam(':customer_id', $user_id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdvertizerTickets($id)
    {
        $query = "SELECT ticket.*, event.name, event.time, event.address
              FROM ticket
              JOIN event ON ticket.event_id = event.id
              WHERE event.advertizer_id = :id AND ticket.confirmed IS NULL ORDER BY time DESC";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomerTickets($customer_id)
    {
        $query = "SELECT ticket.*, event.name, event.time, event.cancelled 
          FROM ticket 
          JOIN event ON ticket.event_id = event.id 
          WHERE ticket.customer_id = :customer_id ORDER BY time ASC";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':customer_id', $customer_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function payTicket($event_id, $user_id)
    {
        $query = "INSERT INTO ticket (event_id, customer_id, paid) VALUES (:event_id, :customer_id, NOW())";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':event_id', $event_id);
        $statement->bindParam(':customer_id', $user_id);

        $statement->execute();

        return $statement;
    }

    public function confirmTicket($id)
    {
        $query = "UPDATE ticket SET confirmed = NOW(), code = UUID() WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement;
    }

}
