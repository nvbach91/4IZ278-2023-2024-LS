<?php

session_start();
require '../Model/ProductDB.php';

$ids = @$_SESSION['cart'];
$products = [];
$productPrice = [];
$priceSum;

if (is_array($ids) && count($ids)) {
    $productDB = new ProductDB();
    foreach ($ids as $id) {
        $productBuy = $productDB->find('products', 'product_id', $id)[0];
        array_push($products, $productBuy);
        array_push($productPrice, $productBuy['price']);
    }

    $priceSum = array_sum($productPrice);
    
    
    
    
    // # retezec s otazniky pro predani seznamu ids
    // # pocet otazniku = pocet prvku v poli ids
    // # pokud mam treba v ids 1,2,3, vrati mi ?,?,?
    // $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    // $priceSum = $productDB->getPriceSum($idsForDatabase)[0];
    // $stmt = $db->prepare("SELECT * FROM cv08_goods WHERE id IN ($question_marks) ORDER BY name");
    // # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
    // $stmt->execute(array_values($ids));
    // $goods = $stmt->fetchAll();
    
    
    // $stmt_sum = $db->prepare("SELECT SUM(price) FROM cv08_goods WHERE id IN ($question_marks)");
    // # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
    // $stmt_sum->execute(array_values($ids));
    // $sum = $stmt_sum->fetchColumn();
}
// header('Location: ../View/cart.php');
// exit(); 
?>