<?php

namespace Vilem\BookBookGo\database;

use DbConnection;
require_once __DIR__ . "/DbConnection.php";
require_once __DIR__ . "/IAuthorRepository.php";
require_once __DIR__ . "/Author.php";

class AuthorRepository implements IAuthorRepository
{
    function __construct()
    {
        
    }
    public function getAuthorById($id) : ?Author
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT * FROM AUTHORS WHERE AUTHORS.ID_AUTHOR = :id LIMIT 1");
            $statement->execute(["id" => $id]);
            $queryResult = $statement->fetchAll();
            if (empty($queryResult)) {
                return null;
            }
            $author = new Author(
                $queryResult[0]["ID_AUTHOR"],
                $queryResult[0]["NAME"],
            );
            return $author;
        }
        catch (PDOException $e) {
            exit("Error connection to the database: " . $e->getMessage());
        }
    }

    public function getAuthorByName($name) : ?Author
    {
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT * FROM AUTHORS WHERE AUTHORS.NAME LIKE :name LIMIT 1");
            $statement->execute(["name" => $name]);
            $queryResult = $statement->fetchAll();
            if (empty($queryResult)) {
                return null;
            }
            $author = new Author(
                $queryResult[0]["ID_AUTHOR"],
                $queryResult[0]["NAME"],
            );

            return $author;
        }
        catch (PDOException $e) {
            exit("Error connection to the database: " . $e->getMessage());
        }
    }

    public function createAuthor(string $name)
    {
        $existingAuthor = $this->getAuthorByName($name);
        if ($existingAuthor !== null) {
            return;
        }
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("INSERT INTO AUTHORS (NAME) VALUES (:name)");
            $statement->execute(["name" => $name]);
        }
        catch (PDOException $e) {
            exit("Error connection to the database: " . $e->getMessage());
        }
    }
}