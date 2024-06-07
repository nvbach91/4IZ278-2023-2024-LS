<?php
session_start();
require_once __DIR__ . '/../db/ProductsDB.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    echo "Nemáte oprávnění přistupovat na tuto stránku.";
    exit();
}

if (isset($_POST['product_id'])) {
    $productsDB = new ProductsDB();
    $product_id = $_POST['product_id'];
    $product = $productsDB->findByProductId($product_id);

    if ($product) {
        $img_format = $product['img_format'];
        $image_path = __DIR__ . "/../assets/product_img/{$product_id}.{$img_format}";

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $productsDB->delete($product_id);
    }

    header('Location: ../manage-products.php');
    exit();
} else {
    echo "Neplatné ID produktu.";
    exit();
}
?>
