<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. "/authentication/AuthUtils.php";
require_once __DIR__ . "/requires/page.php";
require_once __DIR__ . "/database/BookRepository.php";
require_once __DIR__ . "/requires/filters.php";

session_start();

$pageNumber = 0;

if(isset($_GET["page"])){
    $pageNumber = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT);;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Home</title>
</head>
<body>
    <?php require './requires/navigation.php'; ?>

    <div class="contrainer px-4">
        <div class="row">
            <!-- sidebar -->
             <aside class="col-2 container border-end border-1">
                <?php drawFilters(); ?>
             </aside>

             <!-- content -->

             <?php drawPage($pageNumber, false); ?>
        </div>
    </div>
    

    
    


    <script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>