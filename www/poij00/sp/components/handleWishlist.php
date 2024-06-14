<?php
require '../database/ProductsDB.php';




$ids = @$_SESSION['wishlist'];
if (is_array($ids) && count($ids)>0) {

    $question_marks = str_repeat('?,', count($ids) - 1).'?';


    $products = $productsDB->findByMore('product_id', $ids);


  }





  ?>