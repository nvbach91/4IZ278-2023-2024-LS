<?php
require_once ('db/db.php');
$db = new $productsDB;
if (isset ($_GET['category'])) {
    $category_id = htmlspecialchars($_GET['category']);
}
if (empty ($category_id)) {
    $products = $db->getProducts();
} else {
    $products = $db->getCategoryProducts($category_id);
}
?>

<div class="row">
    <?php foreach ($products as $product) {
        echo '<div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="#!"><img class="card-img-top" src="' . $product->img . '" alt="' . $product->name . '" /></a>
            <div class="card-body">
                <h4 class="card-title"><a href="#!">' . $product->name . '</a></h4>
                <h5>' . $product->price . ',-</h5>
                
            </div>
        </div>
    </div>';
    } ?>

</div>