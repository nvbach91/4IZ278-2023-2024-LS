<?php

require_once __DIR__ . "/../database/BookRepository.php";
require_once __DIR__ . "/../config.php";

function drawPage(int $pageNumber) {
    $repo = new BookRepository();
    $books = $repo->getBooksPage($pageNumber,BookRepository::TITLE, true);
    $allBooksCount =  $repo->getBookCount();
    $pagesCount =  intdiv($allBooksCount, ITEMS_PER_PAGE);
    if($allBooksCount % ITEMS_PER_PAGE > 0){
        $pagesCount++;
    }

    $result = '<main class="col-10 container">';

    for ($i=0; $i < count($books); $i++) {

        $desc = $books[$i]->description;
        if(strlen($desc) > 60){
            $desc = substr($desc, 0, 60);
            $desc .= "...";
        }

        if($i % 4 == 0){
            $result .='<div class="row mb-1" style="height: 430px; max-height: 430px;">';
        }

        $result .='
            <div class="col-3 card border-0" style="max-height: 430px;">
                <img class="card-image object-fit-contain" src="'. BASE_URL . $books[$i]->image_url . '" alt="">
                <div class="card-body">
                    <h5 class="card-title">'. $books[$i]->title .'</h5>
                    <p class="card-text">'. $desc .'</p>
                    <p class="card-text fw-bold fs-4">' . $books[$i]->price . ' CZK</p>
                    <div style="height: auto;"></div>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                </div>
            </div>';

        if($i % 3 == 0 && $i > 0){
            $result .='</div>';
        }
    }

    if(count($books) - 1 % 3 != 0){
        $result .='</div>';
    }

    if($pageNumber > 0){
        $result .='<div class="row mb-1">
        <nav class="col-12" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="'. BASE_URL .'/index.php?page='. $pageNumber-1 .'">Previous</a></li>';
    }
    else{
        $result .='<div class="row mb-1">
                    <nav class="col-12" aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="'. BASE_URL .'/index.php?page='. $pageNumber.'">Previous</a></li>';
    }

    

    for ($i=0; $i < $pagesCount; $i++) {
        if($i === $pageNumber){
            $result .= '<li class="page-item active" aria-current="page"><a class="page-link" href="'. BASE_URL .'/index.php?page='. $i .'">'. $i+1 .'</a></li>';
        }
        else{
            $result .= '<li class="page-item"><a class="page-link" href="'. BASE_URL .'/index.php?page='. $i .'">'. $i+1 .'</a></li>';
        }
    }


    
    if( $pageNumber < $pagesCount -1){
        $result .= '<li class="page-item"><a class="page-link" href="'. BASE_URL .'/index.php?page='. $pageNumber+1 .'">Next</a></li>
                    </ul></nav></div>';
    }
    else{
        $result .= '<li class="page-item"><a class="page-link" href="'. BASE_URL .'/index.php?page='. $pageNumber .'">Next</a></li>
                    </ul></nav></div>';
    }
    

    $result .='</main>';
    

    echo $result;

    
}

?>