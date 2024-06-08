<?php

require_once __DIR__ . "/DTOs/BookDTO.php";
require_once __DIR__ . "/DTOs/BookWithIdDTO.php";


interface IBookRepository{

    public function getAllBooks(?array $ids) : array;
    public function getBookById($id) : ?BookWithIdDTO;

    public function getBooksPage(int $pageNumber, int $orderby = 0, bool $asc = true) : array;
    public function getBookCount() : int;


    public function getSearchBooksPage(string $query, int $page) : array;
    public function getSearchBooksCount(string $query) : int;

    public function createBook(BookDTO $book);
    public function updateBook(int $id, BookDTO $book);
}
?>