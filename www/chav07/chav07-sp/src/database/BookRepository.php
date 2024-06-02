<?php 
require_once __DIR__ . "/../database/dbconnection.php";
require_once __DIR__ . "/IBookRepository.php";
require_once __DIR__ . "/../config.php";

class BookRepository implements IBookRepository{
    
    public function getAllBooks() : array{

        return array();

    }
    public function getBookById($id) : ?BookWithIdDTO{


        return null;
    }
    public const TITLE = 0;
    public const PRICE = 1;
    public const AUTHOR = 2;



    public function getBooksPage(int $pageNumber, int $orderby = 0, bool $asc = true) : array{

        try{
            $pdo = DbConnection::getConnection();
            $statement = false;
            if($asc){
                if($orderby == 0){
                    $statement = $pdo->prepare("SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE,
                            BOOKS.DESCRIPTION,
                            BOOKS.PRICE,
                            BOOKS.STOCK,
                            BOOKS.ISBN13,
                            BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS
                            LEFT JOIN AUTHORS
                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                        ORDER BY BOOKS.TITLE ASC
                        LIMIT :items OFFSET :page_number;");
                }
                elseif($orderby == 1){
                    $statement = $pdo->prepare("SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE,
                            BOOKS.DESCRIPTION,
                            BOOKS.PRICE,
                            BOOKS.STOCK,
                            BOOKS.ISBN13,
                            BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS
                            LEFT JOIN AUTHORS
                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                        ORDER BY BOOKS.PRICE ASC
                        LIMIT :items OFFSET :page_number;");
                }
                else{
                    $statement = $pdo->prepare("SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE,
                            BOOKS.DESCRIPTION,
                            BOOKS.PRICE,
                            BOOKS.STOCK,
                            BOOKS.ISBN13,
                            BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS
                            LEFT JOIN AUTHORS
                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                        ORDER BY AUTHORS.NAME ASC
                        LIMIT :items OFFSET :page_number;");
                }

                
            }
            else{

                if($orderby == 0){
                    $statement = $pdo->prepare("SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE,
                            BOOKS.DESCRIPTION,
                            BOOKS.PRICE,
                            BOOKS.STOCK,
                            BOOKS.ISBN13,
                            BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS
                            LEFT JOIN AUTHORS
                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                        ORDER BY BOOKS.TITLE DESC
                        LIMIT :items OFFSET :page_number;");
                }
                elseif($orderby == 1){
                    $statement = $pdo->prepare("SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE,
                            BOOKS.DESCRIPTION,
                            BOOKS.PRICE,
                            BOOKS.STOCK,
                            BOOKS.ISBN13,
                            BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS
                            LEFT JOIN AUTHORS
                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                        ORDER BY BOOKS.PRICE DESC
                        LIMIT :items OFFSET :page_number;");
                }
                else{
                    $statement = $pdo->prepare("SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE,
                            BOOKS.DESCRIPTION,
                            BOOKS.PRICE,
                            BOOKS.STOCK,
                            BOOKS.ISBN13,
                            BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS
                            LEFT JOIN AUTHORS
                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                        ORDER BY AUTHORS.NAME DESC
                        LIMIT :items OFFSET :page_number;");
                }
                
            }
            

            $statement->bindValue(":items", ITEMS_PER_PAGE);
            $statement->bindValue(":page_number", $pageNumber * ITEMS_PER_PAGE);
            // $statement->bindValue(":orby", $orderby);

            $statement->execute();
            $fetchedBooks = $statement->fetchAll();
            $result = array();

            foreach($fetchedBooks as $book){
                array_push(
                    $result, 
                    new BookWithIdDTO(
                        $book["ID_BOOK"],
                        $book["AUTHOR_NAME"],
                        $book["TITLE"],
                        $book["DESCRIPTION"],
                        $book["PRICE"],
                        $book["STOCK"],
                        $book["ISBN13"],
                        $book["ISBN10"],
                        $book["IMAGE_URL"]
                        )
                );
            }
            return $result;

        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
        return array();
    }

    public function getBookByTitle(string $title) : ?BookWithIdDTO{
        return null;
    }
    
    public function getBookCount() : int{
        try{
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT COUNT(BOOKS.ID_BOOK) AS BOOK_COUNT FROM BOOKS;");
            $statement->execute();
            $result = $statement->fetchAll()[0]["BOOK_COUNT"];
            return $result;
        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }

        return 0;
    }

    public function createBook(BookDTO $book){

    }
    public function updateBook(int $id, BookDTO $book){

    }
    public function deleteBook(int $id){

    }
}


?>