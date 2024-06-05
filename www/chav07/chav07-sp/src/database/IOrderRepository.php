<?php

namespace Vilem\BookBookGo\database;

use Vilem\BookBookGo\database\DTOs\OrderCreateDTO;

interface IOrderRepository
{
    public function getOrders($page) : array;
    public function getUsersLatestOrder($userID): ?Order;
    public function getOrder($id) : ?Order;
    public function createOrder(OrderCreateDTO $order);
    public function addBookIntoOrder(int $orderId, int $bookId, int $quantity, float $price);

}