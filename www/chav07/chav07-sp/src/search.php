<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. "/authentication/AuthUtils.php";
require_once __DIR__ . "/requires/page.php";
require_once __DIR__ . "/database/BookRepository.php";
require_once __DIR__ . "/requires/filters.php";

session_start();

$pageNumber = 0;
$query = "";

if(isset($_GET["page"]) && isset($_GET["query"])){
    $pageNumber = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT);
    $rawQuery = $_GET["query"];
    $query = htmlspecialchars(strip_tags(trim($rawQuery)));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Search</title>
</head>
<body>
    <div class="d-flex flex-column full-height">
        <?php require './requires/navigation.php'; ?>
        <div class="container-fluid px-4">
            <div class="row">
                <!-- sidebar -->
                 <aside class="col-2 container navbar-spacing">
                    <?php drawFilters(); ?>
                 </aside>

                 <!-- content -->

                 <?php drawPage($pageNumber, true, $query); ?>
            </div>
            <?php
                if (isAuthorized(AuthRole::Admin)){
                    require __DIR__ . "/requires/addButton.php";
                }
            ?>
        </div>

        <?php include __DIR__ . "/includes/footer.php";?>
    </div>
    <script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>