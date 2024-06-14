<?php
if (!empty($_POST)) {
    $productId = htmlspecialchars($_POST['product_id']);
}
header('Location: ../main/editProduct.php');
?>
