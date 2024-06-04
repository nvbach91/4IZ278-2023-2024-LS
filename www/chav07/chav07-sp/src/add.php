<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ ."/authentication/AuthUtils.php";
require_once __DIR__ ."/database/BookRepository.php";

session_start();

if (!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    header("Location: " . BASE_URL . "/");
    exit(401);
}

if (!isAuthorized(AuthRole::Admin)){
    header("HTTP/1.1 403 Forbidden");
    header("Location: " . BASE_URL . "/");
    exit(403);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Create</title>
</head>
<body>
<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main class="container navbar-spacing">
        <h1 class="fs-2">Add book</h1>
        <form class="" action="./edit/create.php" method="post" enctype="multipart/form-data">
            <div class="row g-2">
                <div class="col-6">
                    <label for="bookTitle" class="form-label">Title</label>
                    <input name="bookTitle" id="bookTitle" class="form-control" maxlength="510" type="text" placeholder="The Lord of the Rings" required>
                </div>
                <div class="col-6">
                    <label for="bookAuthor" class="form-label">Author</label>
                    <input name="bookAuthor" id="bookAuthor" class="form-control" maxlength="510" type="text" placeholder="J. R. R. Tolkien" required>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-12">
                    <label for="bookDescription" class="form-label">Description</label>
                    <textarea name="bookDescription" rows="10" id="bookDescription" maxlength="6000" class="form-control" type="text" placeholder="Some description..."></textarea>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-6">
                    <label for="bookPrice" class="form-label">Price</label>
                    <input name="bookPrice"id="bookPrice" class="form-control" type="number" min="1" step="0.01" placeholder="199.90" required>
                </div>
                <div class="col-6">
                    <label for="bookStock" class="form-label">Stock</label>
                    <input name="bookStock"id="bookStock" class="form-control" type="number" placeholder="8" required>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-6">
                    <label for="bookIsbn13" class="form-label">ISBN13</label>
                    <input name="bookIsbn13"id="bookIsbn13" class="form-control" type="text" placeholder="000-00-000-0000-0" maxlength="17" >
                </div>
                <div class="col-6">
                    <label for="bookIsbn10" class="form-label">ISBN10</label>
                    <input name="bookIsbn10"id="bookIsbn10" class="form-control" type="text" placeholder="0-000-00000-0" maxlength="13">
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-12">
                    <label for="bookImage" class="form-label">Image</label>
                    <input name="bookImage"id="bookImage" class="form-control" type="file" accept="image/jpeg, image/png">
                    <div class="form-text">File must be either .jpg or .png and max 5MB</div>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <button class="btn btn-primary col-3" type="submit">Create</button>
            </div>

        </form>
    </main>

    <?php include __DIR__ . "/includes/footer.php";?>
</div>
<script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>