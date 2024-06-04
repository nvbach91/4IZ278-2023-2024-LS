<?php

namespace Vilem\BookBookGo\database;

use BookWithIdDTO;

require_once __DIR__ . "/DTOs/BookWithIdDTO.php";
class CartObject
{
    public int $quantity;
    public BookWithIdDTO $book;

    function __construct(int $quantity, BookWithIdDTO $book)
    {
        $this->book =$book;
        $this->quantity = $quantity;
    }
}