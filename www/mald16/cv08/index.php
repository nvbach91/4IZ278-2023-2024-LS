<?php
require __DIR__ . "/inc/head.php";
require __DIR__ . "/db/db.php";

// Pagination
$productsCount = $db->query("SELECT COUNT(good_id) FROM cv08_goods")->fetchColumn();
$productsPerPage = 4;
$paginations = ceil($productsCount / $productsPerPage);
$productsOnLastPagination = $productsCount % $productsPerPage;

$offset = 0;

if (isset($_GET["offset"])) {
    $offset = $_GET["offset"];
}

$DBproducts = $db->prepare("SELECT * FROM cv08_goods ORDER BY good_id DESC LIMIT :limit OFFSET :offset");
$DBproducts->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
$DBproducts->bindValue(':offset', $offset, PDO::PARAM_INT);
$DBproducts->execute();
$products = $DBproducts->fetchAll();

?>

<main class="container" style="max-width: 90%;min-height: 100vh;">
    <div style="display: flex; justify-content: center; margin-top: 50px">
        <nav>
            <div style="display: flex; justify-content: center"> <a class="btn btn-primary" href="create-item.php">Vytvořit produkt</a>
            </div>
            <hr>
            <ul class="pagination">
                <?php for ($i = 0; $i < $paginations; $i++) : ?>
                    <li class="page-item <?php echo isset($_GET["offset"]) && ($_GET["offset"] / $productsPerPage) == $i ? "active" : "" ?><?php echo !isset($_GET["offset"]) && $i == 0 ? "active" : "" ?>"><a class="page-link" href="?offset=<?php echo $i * $productsPerPage ?>"><?php echo $i + 1 ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <div class="products-wrapper">
        <?php foreach ($products as $product) : ?>
            <div class="card" style="width: 350px; height: min-content;">
                <img class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;" src="<?php echo $product["img"]; ?>" alt="<?php echo $product["name"]; ?> photo">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $product["price"]; ?>$</h6>
                    <p class="card-text"><?php echo $product["description"]; ?></p>
                    <a href="buy.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-primary">Do košíku</a>
                    <a href="edit-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-outline-primary">Upravit</a>
                    <a href="delete-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-outline-secondary">Vymazat</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include __DIR__ . "/inc/foot.php" ?>