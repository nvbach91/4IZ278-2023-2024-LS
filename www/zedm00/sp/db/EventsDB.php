<?php require_once __DIR__ . '/DatabaseConnection.php'; ?>

<?php

class EventsDB
{
    protected $db;

    public function __construct()
    {

        $this->db = DatabaseConnection::getPDOConnection();
    }

    public function getEvents()
    {

        $query = "SELECT * FROM event";

        $statement = $this->db->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getEventsByType()
    {
        // TODO
    }


    public function findEvents($event_id)
    {
        // SQL query to retrieve products by category
        $query = "SELECT * FROM event WHERE id = :event_id";

        // Prepare the query
        $statement = $this->db->prepare($query);

        // Bind the category_id parameter
        $statement->bindParam(':event_id', $event_id);

        // Execute the query
        $statement->execute();

        // Return the result as an array of products
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCustomerTickets($customer_id)
    {
        // SQL query to retrieve all categories
        $query = "SELECT * FROM ticket WHERE customer_id = :customer_id";

        // Prepare the query
        $statement = $this->db->prepare($query);

        // Bind the category_id parameter
        $statement->bindParam(':customer_id', $customer_id);

        // Execute the query
        $statement->execute();

        // Return the result as an array of categories
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
