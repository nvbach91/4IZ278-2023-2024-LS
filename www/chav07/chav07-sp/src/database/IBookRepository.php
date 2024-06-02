<?php

require_once __DIR__ . "/DTOs/BookDTO.php";
require_once __DIR__ . "/DTOs/BookWithIdDTO.php";


interface IBookRepository{

    public function getAllBooks() : array;
    public function getBookById($id) : ?BookWithIdDTO;
    public function getBookByTitle(string $title) : ?BookWithIdDTO;
    public function getBooksPage(int $pageNumber) : array;
    public function getBookCount() : int;
    public function createBook(BookDTO $book);
    public function updateBook(int $id, BookDTO $book);
    public function deleteBook(int $id);
}
?>