<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. "/authentication/AuthUtils.php";
require_once __DIR__ . "/database/BookRepository.php";
require_once __DIR__ . "/config.php";

session_start();

if (!isset($_GET["id"])) {
    header("HTTP/1.1 404 Not Found");
    exit(404);
}
$sanitizedId = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$id = htmlspecialchars($sanitizedId);
$repo = new BookRepository();
$book = $repo->getBookById($id);
if ($book === null) {
    header("HTTP/1.1 404 Not Found");
    exit(404);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Detail</title>
</head>
<body>
    <div class="d-flex flex-column full-height">
        <?php require './requires/navigation.php'; ?>

        <main class="container navbar-spacing">
            <div class="row mt-2 ">
                <h1 class="fs-1 text-center"><?php echo htmlspecialchars($book->title) ?></h1>
            </div>
            <div class="row">
                <h2 class="fs-4 text-center"><?php echo htmlspecialchars($book->authorName) ?></h2>
            </div>
            <div class="row">
                <div class="col-1 col-lg-3">

                </div>
                <div class="col-10 col-lg-6 d-flex flex-column justify-content-center flex-grow-1">
                    <img class="book-detail-image" src="<?php echo htmlspecialchars(BASE_URL) . htmlspecialchars($book->image_url);?>"
                         alt="<?php echo htmlspecialchars($book->title);?>" aria-label="<?php echo htmlspecialchars($book->title);?>">
                </div>
                <div class="col-1 col-lg-3">

                </div>
            </div>
            <div class="row mt-2 text-center">
                <div class="col-4"></div>
                <p class="col-2 fs-4 fw-bold" aria-label="price"><?php echo htmlspecialchars($book->price);?> CZK</p>
                <p class="col-2 fs-5  <?php echo ($book->stock > 0 ? "text-dark" : "text-danger" )?>" aria-label="availability"><?php echo ($book->stock > 0 ? "Available: " . ($book->stock > 10 ? "More than 10" : htmlspecialchars($book->stock) ) . " pcs" : "Not-available" )?></p>
                <div class="col-4"></div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-3 col-1"></div>
                <div class="col-lg-6  col-10 d-flex flex-column flex-lg-row book-detail-buttons justify-content-center">
                    <a class="btn btn-primary" href="#" aria-label="Add to cart">Add to cart</a>
                    <?php if(isAuthorized(AuthRole::Admin)):?>
                        <a class="btn btn-secondary" href="#" aria-label="Edit">Edit</a>
                        <a class="btn btn-danger" href="#" aria-label="Remove">Remove</a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-1"></div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-2 col-1"></div>
                <div class="col-lg-8  col-10 d-flex flex-column">
                    <h2 class="fs-4">Description:</h2>
                    <p><?php echo htmlspecialchars($book->description);?></p>
                </div>
                <div class="col-lg-2 col-1"></div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-2 col-1"></div>
                <div class="col-lg-8  col-10 d-flex justify-content-end flex-row">
                    <p>ISBN <?php echo htmlspecialchars($book->isbn13 ?? $book->isbn10 ?? "");?></p>
                </div>
                <div class="col-lg-2 col-1"></div>
            </div>
        </main>

        <?php include __DIR__ . "/includes/footer.php";?>
    </div>
    <script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
