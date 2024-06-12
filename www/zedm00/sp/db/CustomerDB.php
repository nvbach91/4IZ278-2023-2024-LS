<?php
require_once __DIR__ . '/DB.php';
class CustomerDB extends DB
{

    public function createCustomer($name, $email, $password, $year)
    {
        $query = "INSERT INTO customer (name, email, password, created, birth_year) VALUES (:name, :email, :password, NOW(), :birth_year)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':birth_year', $year);
        $statement->execute();
        $customerId = $this->db->lastInsertId("email");
        return $customerId;
    }

    public function findCustomerByEmail($email)
    {
        $query = "SELECT * FROM customer WHERE email = :email";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}
