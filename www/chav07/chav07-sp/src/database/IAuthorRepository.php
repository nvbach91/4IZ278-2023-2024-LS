<?php

namespace Vilem\BookBookGo\database;
require_once __DIR__ . "/Author.php";

interface IAuthorRepository
{
    public function getAuthorById($id): ?Author;
    public function getAuthorByName($name): ?Author ;
    public function createAuthor(string $name);
}