<?php

require_once './classes/ProductDB.php';

$productDB = new ProductDB();
$products = $productDB->find();

$nItems = $productDB->count();
$nItemsPerPagination = 6;

$nPaginations = ceil($nItems / $nItemsPerPagination);
$nItemsOnLastPagination = $nItems %  $nItemsPerPagination;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $nItemsPerPagination;
    $itemsPerPage = $productDB->fetchItemsPage($offset, $nItemsPerPagination);

?>

<?php require './include/header.php'; ?>
    <?php require './include/navbar.php'; ?>
        <!-- Page Content-->
        <div class="container">
            <div class="row">
                <div class="create-item">
                <a href="create-item.php">Create new item</a>
                </div>
                <div class="pagination">
                    <?php for($i = 0; $i < $nPaginations; $i++) {?>
                        <a href="?page=<?php echo $i +1; ?>"><?php echo $i +1; ?></a>
                    <?php } ?>
                </div>
                <div class="col-lg-9"> 
                    <?php foreach($itemsPerPage as $product): ?>                   
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo $product['img']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $product["price"]; ?>$</h6>
                                <p class="card-text"><?php echo $product["description"]; ?></p>
                                <a href="./buy.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-primary">Do košíku</a>
                                <a href="./update-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-outline-primary">Upravit</a>
                                <a href="delete-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-outline-secondary">Vymazat</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php include './include/footer.php'; ?>