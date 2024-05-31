<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['toggleAvailability'])) {
        $productId = $_POST['productId'];
        $product = $productsDB->readProductById($productId);

        if ($product) {
            $isAvailable = $product[0]['isAvailable'];
            $productsDB->updateProductAvailable($productId, $isAvailable);
            // Refresh the page to show the updated availability status
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
    } elseif (isset($_POST['deleteProduct'])) {
        $productId = $_POST['productId'];
        $productsDB->deleteProduct($productId);
        // Redirect to a different page (e.g., product list) after deletion
        header("Location: index.php");
        exit();
    }
}

$currentUrlParams = $_SERVER['QUERY_STRING'];

$urlParamsArr = explode("&", $currentUrlParams);

$productId = 0;
for($i = 0; $i < count($urlParamsArr); $i++){
    if(str_contains($urlParamsArr[$i], 'productId')){
        $productId = explode('=',$urlParamsArr[$i])[1];
    }
}

$products = $productsDB->readProductById($productId);
$productTypes = $productsDB->readProductTypes($productId);

function getStringOfProductTypes($productTypes){
    $string = "";
    for($i = 0; $i < count($productTypes); $i++ ) {
        if(count($productTypes) - 1 == $i) {
            $string .= htmlspecialchars($productTypes[$i]['typeName'], ENT_QUOTES, 'UTF-8') . ' Tea';
        }
        else {
            $string .= htmlspecialchars($productTypes[$i]['typeName'], ENT_QUOTES, 'UTF-8') . ' Tea, ';
        }
    }
    return $string;
}
?>

<div class="row">
    <?php foreach ($products as $product) : ?>
        <div class="col-lg-8">
            <div>
                <p class="my-4"><a class="btn btn-secondary" href="./index.php">&lt;&lt; Back to Browsing</a></p>
            </div>
            <div class="card mt-5">
                <img class="card-img-top img-fluid img-detail" src="<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image of <?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="card-body">
                    <p class="card-text"><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h1 class="my-4"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <div class="list-group">
                <form method="POST" action="">
                    <div class="list-group-item">
                        <button class="btn <?php if ($product['isAvailable'] == false) {echo 'btn-success';} else {echo 'btn-danger'; }?>" type="submit" name="toggleAvailability"><?php if ($product['isAvailable'] == false) {echo 'Mark as available';} else {echo 'Mark as unavailable'; }?></button>
                        <input type="hidden" name="productId" value="<?= $product['idProduct']; ?>">
                    </div>
                </form>
                <div class="list-group-item">
                    <a href="admin/productsEdit.php?id=<?= $product['idProduct']; ?>" class="btn btn-info">Edit</a>
                </div>
                <form method="POST" action="">
                    <div class="list-group-item">
                        <button class="btn btn-danger" type="submit" name="deleteProduct">Delete</button>
                        <input type="hidden" name="productId" value="<?= $product['idProduct']; ?>">
                    </div>
                </form>
                <div class="list-group-item">
                    <h2><?php if ($product['discount'] > 0) {echo number_format($product['price'] * (1 - 0.01 * $product['discount']), 2), ' CZK';} else {echo number_format($product['price'], 2), ' CZK'; }?></h2>
                    <p><s><?php if ($product['discount'] > 0) {echo number_format($product['price'], 2), ' CZK';} else {echo '';}?></s><b class="<?php if ($product['discount'] > 0) {echo 'green';} ?>"><?php if ($product['discount'] > 0) {echo ' Save ', number_format($product['discount'], 0), ' %';} else {echo '';}?></b><?php if ($product['discount'] > 0) {echo '';} else {echo 'Unfortunately, there is no discount at the moment.';}?></p>
                </div>
                <div class="list-group-item">
                    <p>The product is currently <b class="<?php if ($product['isAvailable'] == false) {echo 'red';} else {echo 'green'; }?>"><?php if ($product['isAvailable'] == false) {echo 'sould out';} else {echo 'in Stock'; }?></b><?php if ($product['isAvailable'] == false) {echo ', we apologize for the inconvenience.';} else {echo '!'; }?></p>
                </div>
                <?php if ($product['isAvailable'] == true) : ?>
                    <div class="list-group-item">
                        <input type="number" value="1" min="1" max="20" title="How many pcs do you want to add to cart?" <?php if ($product['isAvailable'] == false) {echo 'disabled';} else {echo ''; }?>>
                        <a id="addToCartLink" class="btn btn-info" href="./buy.php?productId=<?php echo $product['idProduct']?>&quantity=1" <?php if ($product['isAvailable'] == false) {echo 'disabled';} else {echo '' ; }?>>Add to Cart</a>
                    </div>
                <?php else : ?>
                    <div></div>
                <?php endif; ?>

            </div>
            <br>
            <div class="list-group">
                <div class="list-group-item">
                    <p> <?php echo getStringOfProductTypes($productTypes) ?> </p> 
                </div>
                
                <div class="list-group-item">
                    <p>Contains Caffeine-Free Tea: <b class="<?php if ($product['isCaffeineFree'] == true) {echo 'green';} else {echo 'red';} ?>"><?php if ($product['isCaffeineFree'] == true) {echo "Yes";} else {echo "No";} ?></b></p>
                </div>
                <div class="list-group-item">
                    <p>Is suitable as a Gift Set: <b class="<?php if ($product['isGiftSet'] == true) {echo 'green';} else {echo 'red';} ?>"><?php if ($product['isGiftSet'] == true) {echo "Yes";} else {echo "Probably Not";} ?></b></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<script>
document.getElementById('quantityInput').addEventListener('change', function() {
    var quantity = this.value;
    document.getElementById('addToCartLink').href = "./buy.php?productId=<?php echo $product['idProduct']?>&quantity=" + quantity;
});
</script>
