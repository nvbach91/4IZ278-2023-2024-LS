<?php

namespace Vilem\BookBookGo\database;

use DbConnection;
use PDO;
use Vilem\BookBookGo\database\DTOs\OrderCreateDTO;
use Vilem\BookBookGo\database\IOrderRepository;

require_once __DIR__ . "/DbConnection.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/IOrderRepository.php";
require_once __DIR__ . "/Order.php";
require_once __DIR__ . "/DTOs/OrderCreateDTO.php";


class OrderRepository implements IOrderRepository
{

    public function getOrders($page) : array
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT * FROM ORDERS 
                                                        LIMIT :limit OFFSET :offset");
            $statement->execute([
                "limit" => ITEMS_PER_PAGE,
                "offset" => ITEMS_PER_PAGE * $page
            ]);
            $orders = $statement->fetchAll();
            $result = array();
            foreach ($orders as $order) {
                array_push($result, new Order(
                    $order["ID_ORDER"],
                    $order["USER_ID"],
                    $order["PAID"],
                    $order["DELIVERED"],
                    $order["STREET"],
                    $order["CITY"],
                    $order["POST_CODE"],
                    $order["PHONE"],
                ));
            }
            return $result;


        }
        catch (PDOException $e) {

        }
    }

    public function getOrder($id) : ?Order
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT * FROM ORDERS WHERE ID_ORDER = :id LIMIT 1");
            $statement->execute([
                "id" => $id
            ]);
            $result = $statement->fetchAll()[0];
            if ($result == null) {
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
                $result["PHONE"],
            );
        }
        catch (PDOException $e) {
            exit("Error while connecting to the database: " . $e->getMessage());
        }
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

    public function getOrderCount(): int
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT COUNT(*) AS ORDER_COUNT FROM ORDERS");
            $statement->execute();
            return $statement->fetchAll()[0]["ORDER_COUNT"];

        }
        catch (PDOException $e) {
            exit("Error while connecting to the database: " . $e->getMessage());
        }
    }

    public function updateOrder(Order $order)
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("UPDATE ORDERS SET
                                                    PAID = :paid,
                                                    DELIVERED = :delivered
                                                WHERE ID_ORDER = :id");
            $statement->execute([
                "paid" => (int)$order->paid,
                "delivered" => (int)$order->delivered,
                "id" => $order->id
            ]);
        }
        catch (PDOException $e) {
            exit("Error while connecting to the database: " . $e->getMessage());
        }
    }
}