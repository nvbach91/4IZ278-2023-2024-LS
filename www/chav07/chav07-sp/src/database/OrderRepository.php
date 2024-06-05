<?php

namespace Vilem\BookBookGo\database;

use DbConnection;
use Vilem\BookBookGo\database\DTOs\OrderCreateDTO;
use Vilem\BookBookGo\database\IOrderRepository;

require_once __DIR__ . "/DbConnection.php";
class OrderRepository implements IOrderRepository
{

    public function getOrders($page) : array
    {

    }

    public function getOrder($id) : ?Order
    {

    }


    public function createOrder(OrderCreateDTO $order)
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("INSERT INTO ORDERS(USER_ID, PAID, DELIVERED, STREET, CITY, POST_CODE, PHONE) 
                                        VALUES(:userID, :paid, :delivered, :street ,:city, :postCode, :phone)");
            $statement->execute([
                "userID" => $order->userId,
                "paid" => (int)$order->paid,
                "delivered" => (int)$order->delivered,
                "street" => $order->street,
                "city" => $order->city,
                "postCode" => $order->postalCode,
                "phone" => $order->phone
            ]);
        }
        catch (PDOException $e) {
            exit("Error while connecting to the database: " . $e->getMessage());
        }
    }

    public function getUsersLatestOrder($userID): ?Order
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT ORDERS.ID_ORDER, ORDERS.USER_ID, ORDERS.PAID, ORDERS.DELIVERED, ORDERS.STREET, ORDERS.CITY, ORDERS.POST_CODE, ORDERS.PHONE
                                           FROM ORDERS WHERE ORDERS.USER_ID = :id ORDER BY ORDERS.ID_ORDER DESC LIMIT 1");
            $statement->execute([
                "id" => $userID
            ]);
            $result = $statement->fetchAll()[0];
            if (empty($result)) {
                return null;
            }
            return new Order(
                $result["ID_ORDER"],
                $result["USER_ID"],
                $result["PAID"],
                $result["DELIVERED"],
                $result["STREET"],
                $result["CITY"],
                $result["POST_CODE"],
                $result["PHONE"]
            );
        }
        catch (PDOException $e) {
            exit("Error while connecting to the database: " . $e->getMessage());
        }
    }

    public function addBookIntoOrder(int $orderId, int $bookId, int $quantity, float $price)
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("INSERT INTO HAS (ID_BOOK, ID_ORDER, COUNT, PRICE) VALUES (:bookId, :orderId, :quantity, :price)");
            $statement->execute([
                "orderId" => $orderId,
                "bookId" => $bookId,
                "quantity" => $quantity,
                "price" => $price
            ]);
        }
        catch (PDOException $e) {
            exit("Error while connecting to the database: " . $e->getMessage());
        }


    }
}