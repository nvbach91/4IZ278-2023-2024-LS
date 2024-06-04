<?php

require_once __DIR__ . "/../database/BookRepository.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";

function drawPage(int $pageNumber, bool $isSearch, ?string $query = null) {
    session_start();
    $repo = new BookRepository();
//
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlComponents = parse_url($currentUrl);
    if (isset($urlComponents['query'])) {
        parse_str($urlComponents['query'], $params);
    }
    $asc = true;
    $orderBy = 0;
    if (isset($params['orderBy'])) {
        $orderByQuery = $params['orderBy'];
        switch ($orderByQuery) {
            case 1:
                $orderBy = $repo::TITLE;
                $asc = true;
                break;
            case 2:
                $orderBy = $repo::TITLE;
                $asc = false;
                break;
            case 3:
                $orderBy = $repo::PRICE;
                $asc = true;
                break;
            case 4:
                $orderBy = $repo::PRICE;
                $asc = false;
                break;
            case 5:
                $orderBy = $repo::AUTHOR;
                $asc = true;
                break;
            case 6:
                $orderBy = $repo::AUTHOR;
                $asc = false;
                break;
            default:
                $orderBy = $repo::TITLE;
                $asc = true;
                break;
        }
    }

    $books = array();
    $allBooksCount = 0;
    if($isSearch && $query != null){
        $books = $repo->getSearchBooksPage($query, $pageNumber, $orderBy, $asc);
        $allBooksCount =  $repo->getSearchBooksCount($query);
    }
    else{
        $books = $repo->getBooksPage($pageNumber,$orderBy, $asc);
        $allBooksCount =  $repo->getBookCount();
    }


    $pagesCount =  intdiv($allBooksCount, ITEMS_PER_PAGE);
    if($allBooksCount % ITEMS_PER_PAGE > 0){
        $pagesCount++;
    }

    $result = '<main class="col-10 container navbar-spacing">';
    if($isSearch){
        $result .='<h3 class="mb-2">Results for: ' . htmlspecialchars($query) . '</h3>';
    }

    for ($i=0; $i < count($books); $i++) {

        $desc = $books[$i]->description;
        if(strlen($desc) > 60){
            $desc = substr($desc, 0, 60);
            $desc .= "...";
        }

        if($i % 4 == 0){
            $result .='<div class="row mb-1" >';
        }

        $result .='
            <div class="col-3 card border-0" >
                <img class="card-image object-fit-contain" src="'. BASE_URL . $books[$i]->image_url . '" alt="">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">'. $books[$i]->title .'</h5>
                    <h6 class="card-text">'. $books[$i]->authorName .'</h6>
                    <p class="card-text">'. $desc .'</p>
                    <div class="card-filler"></div>
                    <p class="card-text fw-bold fs-4">' . $books[$i]->price . ' CZK</p>
                    <div class="d-flex flex-xl-row flex-sm-column">
                        <a href="' . htmlspecialchars(BASE_URL . "/cart/add.php?id=" . $books[$i]->id) . '" class="btn btn-primary me-xl-1 mb-sm-1">Add to cart</a>
                        <a href="'. BASE_URL . htmlspecialchars("/book.php?id=") . htmlspecialchars($books[$i]->id) .'" class="btn btn-secondary mb-sm-1 me-xl-1">Detail</a>'
                        . (isAuthorized(AuthRole::Admin) ? '<a href="'. BASE_URL . htmlspecialchars("/edit.php?id=") . htmlspecialchars($books[$i]->id) .'" class="btn btn-secondary mb-sm-1">Edit</a>' : '') .
                    '</div>
                </div>
            </div>';

        if($i+1 % 4 == 0 && $i > 0){
            $result .='</div>';
        }
    }

    if(count($books) - 1 % 3 != 0){
        $result .='</div>';
    }

    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlComponents = parse_url($currentUrl);
    if (isset($urlComponents['query'])) {
        parse_str($urlComponents['query'], $params);
    }


    $actualPath = "http://" . $urlComponents["host"] . $urlComponents["path"];
    if ($isSearch){
        $actualPath .= "?query=" . urlencode($query);
    }


    if($pageNumber > 0){

        $actualPath .= ($isSearch ? "&page=" : "?page=") . urldecode($pageNumber - 1);

        $result .='<div class="row mb-1">
        <nav class="col-12" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="'. $actualPath . '">Previous</a></li>';
    }
    else{
        $actualPath .= ($isSearch ? "&page=" : "?page=") . urldecode($pageNumber);
        $result .='<div class="row mb-1">
                    <nav class="col-12" aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="'. $actualPath .'">Previous</a></li>';
    }

    //path without parameters
    $actualPath = "http://" . $urlComponents["host"] . $urlComponents["path"];

    $counter = 0;
    foreach ($params as $key => $value) {
        if ($key == "page") {
            continue;
        }
        $actualPath .= ($counter == 0 ? "?" : "&") . $key . "=" . $value;
        $counter++;
    }
    $counter > 0 ? $actualPath .= "&page=" : $actualPath .= "?page=";

//    if ($isSearch){
//        $actualPath .= "?query=" . urlencode($query) . "&page=";
//    }
//    else{
//        $actualPath .= "?page=";
//    }

    for ($i=0; $i < $pagesCount; $i++) {
        if($i === $pageNumber){
            $result .= '<li class="page-item active" aria-current="page"><a class="page-link" href="'. $actualPath . $i .'">'. $i+1 .'</a></li>';
        }
        else{
            $result .= '<li class="page-item"><a class="page-link" href="'. $actualPath .  "" . $i .'">'. $i+1 .'</a></li>';
        }
    }



    if( $pageNumber < $pagesCount -1){

        $result .= '<li class="page-item"><a class="page-link" href="'. $actualPath . $pageNumber+1 . '">Next</a></li>
                    </ul></nav></div>';
    }
    else{
        $result .= '<li class="page-item"><a class="page-link" href="'. $actualPath . $pageNumber.'">Next</a></li>
                    </ul></nav></div>';
    }


    $result .='</main>';


    echo $result;

    
}

?>