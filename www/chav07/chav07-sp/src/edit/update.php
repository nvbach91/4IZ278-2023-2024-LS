<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/fileUploadUtils.php";
require_once __DIR__ . "/../database/BookRepository.php";
require_once __DIR__ . "/../database/Author.php";

use Vilem\BookBookGo\database\AuthorRepository;
if(
    isset($_POST["bookId"]) &&
    isset($_POST["bookTitle"]) &&
    isset($_POST["bookAuthor"]) &&
    isset($_POST["bookDescription"]) &&
    isset($_POST["bookPrice"]) &
    isset($_POST["bookStock"]) &&
    isset($_POST["bookIsbn13"]) &&
    isset($_POST["bookIsbn10"])
    ){

    $bookId = filter_var($_POST["bookId"],FILTER_SANITIZE_NUMBER_INT);
    $bookTitle = htmlspecialchars(trim($_POST["bookTitle"]));
    $bookAuthor = htmlspecialchars(trim($_POST["bookAuthor"]));
    $bookDescription = htmlspecialchars(trim($_POST["bookDescription"]));
    $bookPrice = filter_var($_POST["bookPrice"], FILTER_SANITIZE_NUMBER_INT);
    $bookStock = filter_var($_POST["bookStock"],FILTER_SANITIZE_NUMBER_INT);
    $bookIsbn13 = htmlspecialchars(trim($_POST["bookIsbn13"]));
    $bookIsbn10 = htmlspecialchars(trim($_POST["bookIsbn10"]));

//
    $bookRepo = new BookRepository();
    $authorRepository = new AuthorRepository();
//
    $currentBook = $bookRepo->getBookById($bookId);
    if($currentBook == null){
        header("location:" . BASE_URL . "/");
        exit(404);
    }

    if ($bookPrice < 1 || $bookStock < 0){
        header("location:" . BASE_URL . "/edit.php?id=" . $bookId);
        exit(400);
    }


    $url = handleFileUpload();
    if ($url === null){
        $url = $currentBook->image_url;
    }
//
    $author = $authorRepository->getAuthorByName($bookAuthor);
    if ($author == null){
        $authorRepository->createAuthor($bookAuthor);
        $author = $authorRepository->getAuthorByName($bookAuthor);
    }
//
    $updatedBook = new BookDTO(
        $author->id,
        $bookTitle,
        $bookDescription,
        $bookPrice,
        $bookStock,
        $bookIsbn13,
        $bookIsbn10,
        $url
    );

    $bookRepo->updateBook($bookId ,$updatedBook);
    header("location:" . BASE_URL . htmlspecialchars("/edit.php?id=" . $bookId));
    exit(200);




}
else{
    echo "Missing parameters";
    header("location:" . BASE_URL . "/");
    exit(404);
}

?>
