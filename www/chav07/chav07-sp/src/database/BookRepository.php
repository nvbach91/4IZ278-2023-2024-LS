<?php 
require_once __DIR__ . "/../database/DbConnection.php";
require_once __DIR__ . "/IBookRepository.php";
require_once __DIR__ . "/../config.php";

class BookRepository implements IBookRepository{
    
    public function getAllBooks(?array $ids) : array{

        try {
            $pdo = DbConnection::getConnection();
            $queryBase = "SELECT 
                            BOOKS.ID_BOOK,
                            AUTHORS.NAME AS AUTHOR_NAME,
                            BOOKS.TITLE, BOOKS.DESCRIPTION,
                            BOOKS.PRICE, BOOKS.STOCK,
                            BOOKS.ISBN13, BOOKS.ISBN10,
                            BOOKS.IMAGE_URL
                        FROM BOOKS 
                        JOIN AUTHORS 
                            ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR 
                         ";

            $selection = "";
            if (!empty($ids)) {
                $selection .= "WHERE";
                for ($i = 0; $i < count($ids); $i++) {

                    $selection .= " BOOKS.ID_BOOK = :id".$i;
                    if ($i != count($ids) - 1) {
                        $selection .= " OR ";
                    }
                }
            }
            $params = array();
            for($i = 0; $i < count($ids); $i++){
                $params[":id".$i] = $ids[$i];
            }

            $statement = $pdo->prepare($queryBase . $selection);
            $statement->execute($params);
            $result = $statement->fetchAll();
            $mappedBooks = array_map(function ($book){
                return new BookWithIdDTO(
                    $book["ID_BOOK"],
                    $book["AUTHOR_NAME"],
                    $book["TITLE"],
                    $book["DESCRIPTION"],
                    $book["PRICE"],
                    $book["STOCK"],
                    $book["ISBN13"],
                    $book["ISBN10"],
                    $book["IMAGE_URL"]
                );
            }, $result);

            return $mappedBooks;

        }
        catch (PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
        return array();

    }
    public function getBookById($id) : ?BookWithIdDTO{
        try {
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT 
                                                BOOKS.ID_BOOK,
                                                AUTHORS.NAME AS AUTHOR_NAME,
                                                BOOKS.TITLE, BOOKS.DESCRIPTION,
                                                BOOKS.PRICE, BOOKS.STOCK,
                                                BOOKS.ISBN13, BOOKS.ISBN10,
                                                BOOKS.IMAGE_URL
                                            FROM BOOKS
                                            JOIN AUTHORS
                                                ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                                            WHERE BOOKS.ID_BOOK = :id LIMIT 1");
            $statement->bindParam(":id", $id);
            $statement->execute();
            $result = $statement->fetchAll();
            if (empty($result)) {
                return null;
            }
            $book = new BookWithIdDTO(
                $result[0]["ID_BOOK"],
                $result[0]["AUTHOR_NAME"],
                $result[0]["TITLE"],
                $result[0]["DESCRIPTION"],
                $result[0]["PRICE"],
                $result[0]["STOCK"],
                $result[0]["ISBN13"],
                $result[0]["ISBN10"],
                $result[0]["IMAGE_URL"],
            );
            return $book;

        }
        catch (PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
    }
    public const TITLE = 0;
    public const PRICE = 1;
    public const AUTHOR = 2;



    public function getBooksPage(int $pageNumber, int $orderby = 0, bool $asc = true) : array{

        try{
            $pdo = DbConnection::getConnection();
            $statement = false;
            $queryOrder = self::getSQLOrderByStatement($orderby, $asc);    
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
                                            ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR "
                                            . $queryOrder . "
                                    LIMIT :items OFFSET :page_number;");
            

            $statement->bindValue(":items", ITEMS_PER_PAGE);
            $statement->bindValue(":page_number", $pageNumber * ITEMS_PER_PAGE);

            $statement->execute();
            $fetchedBooks = $statement->fetchAll();
            $result = $this->mapBooksWithIdDTOs($fetchedBooks);
            return $result;

        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
    }

    public function getSearchBooksPage(string $query, int $page, int $orderby = 0, bool $asc = true) : array{

        try{
            $pdo = DbConnection::getConnection();
            $queryOrder = self::getSQLOrderByStatement($orderby, $asc);
            $statement = $pdo->prepare("SELECT ID_BOOK, AUTHORS.NAME AS AUTHOR_NAME, TITLE, DESCRIPTION, PRICE, STOCK, ISBN13, ISBN10, IMAGE_URL
                                        FROM BOOKS
                                        LEFT JOIN AUTHORS
                                            ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                                        WHERE BOOKS.TITLE LIKE :query1 OR AUTHORS.NAME LIKE :query2 "
                                        . $queryOrder ."
                                        LIMIT :item_count OFFSET :page_offset");


            $statement->bindValue(":query1", "%" . $query . "%");
            $statement->bindValue(":query2", "%" . $query . "%");
            $statement->bindValue(":item_count", ITEMS_PER_PAGE);
            $statement->bindValue(":page_offset", $page * ITEMS_PER_PAGE);

            $statement->execute();

            $fetchedBooks = $statement->fetchAll();
            $result = $this->mapBooksWithIdDTOs($fetchedBooks);
            return $result;

        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
    }
    public function getSearchBooksCount(string $query) : int{
    
        try{

            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT COUNT(BOOKS.ID_BOOK) AS BOOK_COUNT
                                        FROM BOOKS 
                                        LEFT JOIN AUTHORS 
                                            ON BOOKS.ID_AUTHOR = AUTHORS.ID_AUTHOR
                                        WHERE BOOKS.TITLE LIKE :query1 OR AUTHORS.NAME LIKE :query2");

            $statement->bindValue(":query1", "%" . $query . "%");
            $statement->bindValue(":query2", "%" . $query . "%");

            $statement->execute();

            $result = $statement->fetchAll()[0]["BOOK_COUNT"];
            
            return $result;

        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }

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
    }

    public function createBook(BookDTO $book){
        try{
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("INSERT INTO 
                                                BOOKS(BOOKS.ID_AUTHOR, BOOKS.TITLE, BOOKS.DESCRIPTION, BOOKS.PRICE, BOOKS.STOCK, BOOKS.ISBN13, BOOKS.ISBN10, BOOKS.IMAGE_URL)
                                                VALUES(:authorId, :title, :description, :price, :stock, :isbn13, :isbn10, :imageUrl); ");
            $statement->execute([
                "authorId" => $book->authorId,
                "title" => $book->title,
                "description" => $book->description,
                "price" => $book->price,
                "stock" => $book->stock,
                "isbn13" => $book->isbn13,
                "isbn10" => $book->isbn10,
                "imageUrl" => $book->image_url
            ]);
        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
    }
    public function updateBook(int $id, BookDTO $book){
        try{
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("UPDATE BOOKS 
                SET BOOKS.ID_AUTHOR = :authorId,
                    BOOKS.TITLE = :title,
                    BOOKS.DESCRIPTION = :description,
                    BOOKS.PRICE = :price,
                    BOOKS.STOCK = :stock,
                    BOOKS.ISBN13 = :isbn13,
                    BOOKS.ISBN10 = :isbn10,
                    BOOKS.IMAGE_URL = :image_url
                    WHERE BOOKS.ID_BOOK = :bookId");
            $statement->execute([
                "bookId" => $id,
                "authorId" => $book->authorId,
                "title" => $book->title,
                "description" => $book->description,
                "price" => $book->price,
                "stock" => $book->stock,
                "isbn13" => $book->isbn13,
                "isbn10" => $book->isbn10,
                "image_url" => $book->image_url
            ]);
        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
    }

    private function mapBooksWithIdDTOs($array) : array {
        $result = array();

        foreach($array as $book){
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

    private static function getSQLOrderByStatement(int $orderby, bool $asc) : string{
            $orderByTitle = "ORDER BY BOOKS.TITLE ";
            $orderByPrice = "ORDER BY BOOKS.PRICE ";
            $orderByAuthor = "ORDER BY AUTHORS.NAME ";
            $queryOrder = "";

            switch ($orderby) {
                case self::TITLE:
                    $queryOrder = $orderByTitle;
                    break;
                case self::PRICE:
                    $queryOrder = $orderByPrice;
                    break;
                case self::AUTHOR:
                    $queryOrder = $orderByAuthor;
                    break;
                default:
                    $queryOrder = $orderByTitle;
                    break;
            }

            if($asc){
                $queryOrder .= "ASC ";
            }
            else{
                $queryOrder .= "DESC ";
            }


            return $queryOrder;
    }
}


?>