<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ ."/authentication/AuthUtils.php";
require_once __DIR__ ."/database/BookRepository.php";

session_start();

if (!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    exit(401);
}

if (!isAuthorized(AuthRole::Admin)){
    header("HTTP/1.1 403 Forbidden");
    exit(403);
}

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
    <title>BookBookGo - Edit</title>
</head>
<body>
<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main class="container navbar-spacing">
        <h1 class="fs-2">Book editor</h1>
        <form class="" action="./edit/update.php" method="post" enctype="multipart/form-data">
            <div class="row g-2">
                <div class="col-2">
                    <label for="bookId" class="form-label">Book ID</label>
                    <input name="bookId" id="bookId" class="form-control" type="number" value="<?php echo htmlspecialchars($book->id)?>" readonly>
                </div>
                <div class="col-6">
                    <label for="bookTitle" class="form-label">Title</label>
                    <input name="bookTitle" id="bookTitle" class="form-control" type="text" value="<?php echo htmlspecialchars($book->title)?>" required>
                </div>
                <div class="col-4">
                    <label for="bookAuthor" class="form-label">Author</label>
                    <input name="bookAuthor" id="bookAuthor" class="form-control" type="text" value="<?php echo htmlspecialchars($book->authorName)?>" required>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-12">
                    <label for="bookDescription" class="form-label">Description</label>
                    <textarea name="bookDescription" rows="10" id="bookDescription" class="form-control" type="text"><?php echo htmlspecialchars($book->description)?></textarea>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-6">
                    <label for="bookPrice" class="form-label">Price</label>
                    <input name="bookPrice"id="bookPrice" class="form-control" type="number" min="1" value="<?php echo htmlspecialchars($book->price)?>" required>
                </div>
                <div class="col-6">
                    <label for="bookStock" class="form-label">Stock</label>
                    <input name="bookStock"id="bookStock" class="form-control" type="number" min="0"  value="<?php echo htmlspecialchars($book->stock)?>" required>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-6">
                    <label for="bookIsbn13" class="form-label">ISBN13</label>
                    <input name="bookIsbn13"id="bookIsbn13" class="form-control" type="text" maxlength="17" value="<?php echo htmlspecialchars($book->isbn13)?>">
                </div>
                <div class="col-6">
                    <label for="bookIsbn10" class="form-label">ISBN10</label>
                    <input name="bookIsbn10"id="bookIsbn10" class="form-control" type="text" maxlength="13" value="<?php echo htmlspecialchars($book->isbn10)?>">
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-12">
                    <label for="bookImage" class="form-label">Image</label>
                    <input name="bookImage"id="bookImage" class="form-control" type="file" accept="image/jpeg, image/png" maxlength="17" value="<?php echo htmlspecialchars($book->isbn13)?>">
                    <div class="form-text">File must be on of these types: .jpg or .png</div>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <button class="btn btn-primary col-3" type="submit">Update</button>
            </div>

        </form>
    </main>

    <?php include __DIR__ . "/includes/footer.php";?>
</div>
<script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
