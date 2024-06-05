<?php


require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/fileUploadUtils.php";
require_once __DIR__ . "/../database/BookRepository.php";
require_once __DIR__ . "/../database/AuthorRepository.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";

use Vilem\BookBookGo\database\AuthorRepository;

//session_start();
startSessionIfNone();
if (!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    header("location:" . BASE_URL . htmlspecialchars("/"));
    exit(401);
}
if (!isAuthorized(AuthRole::Admin)){
    header("HTTP/1.1 403 Forbidden");
    header("location:" . BASE_URL . htmlspecialchars("/"));
    exit(403);
}

if(
    isset($_POST["bookTitle"]) &&
    isset($_POST["bookAuthor"]) &&
    isset($_POST["bookDescription"]) &&
    isset($_POST["bookPrice"]) &
    isset($_POST["bookStock"]) &&
    isset($_POST["bookIsbn13"]) &&
    isset($_POST["bookIsbn10"])
){

    $bookTitle = htmlspecialchars(trim($_POST["bookTitle"]));
    $bookAuthor = htmlspecialchars(trim($_POST["bookAuthor"]));
    $bookDescription = htmlspecialchars(trim($_POST["bookDescription"]));
    $bookPrice = filter_var($_POST["bookPrice"], FILTER_SANITIZE_NUMBER_INT);
    $bookStock = filter_var($_POST["bookStock"],FILTER_SANITIZE_NUMBER_INT);
    $bookIsbn13 = htmlspecialchars(trim($_POST["bookIsbn13"]));
    $bookIsbn10 = htmlspecialchars(trim($_POST["bookIsbn10"]));


    $bookRepo = new BookRepository();
    $authorRepository = new AuthorRepository();



    if ($bookPrice < 1 || $bookStock < 0){
        header("location:" . BASE_URL . htmlspecialchars("/add.php"));
        exit(400);
    }


    $url = handleFileUpload();
    if ($url === null){
        header("location:" . BASE_URL . htmlspecialchars("/add.php"));
        exit(400);
    }

    $author = $authorRepository->getAuthorByName($bookAuthor);
    if ($author == null){
        $authorRepository->createAuthor($bookAuthor);
        $author = $authorRepository->getAuthorByName($bookAuthor);
    }

    $newBook = new BookDTO(
        $author->id,
        $bookTitle,
        $bookDescription,
        $bookPrice,
        $bookStock,
        $bookIsbn13,
        $bookIsbn10,
        $url
    );

    $bookRepo->createBook($newBook);
    header("location:" . BASE_URL . htmlspecialchars("/add.php"));
    exit(200);

}
else{
    echo "Missing parameters";
    header("location:" . BASE_URL . htmlspecialchars("/add.php"));
    exit(404);
}

?>
