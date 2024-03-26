<?php
include './classes/Products.php';
include './classes/Categories.php';

$productsDB = new ProductsDB();
$categoryDB = new CategoriesDB();
$products = $productsDB->readAll();
$categories = $categoryDB->readAll();

$selectedC = null;
if (!empty($_GET)) {
    $selectedC = $_GET["categoryId"];
    if ($selectedC == 0) {
        $selectedC = null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv06</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <main>
        <div class="categories">
            <h1>Kategorie</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
                <?php foreach ($categories as $c) : ?>

                    <?php if ($selectedC == $c['category_id']) : ?>
                        <button id="selected-button" type="submit" value="<?= $c['category_id'];  ?>" name="categoryId"><?= $c['name'];  ?></button>
                    <?php else : ?>
                        <button type="submit" value="<?= $c['category_id'];  ?>" name="categoryId"><?= $c['name'];  ?></button>
                    <?php endif; ?>

                <?php endforeach; ?>
                <button class="reset" type="submit" value="0" name="categoryId">X</button>
            </form>
        </div>
        <div class="products">
            <?php foreach ($products as $p) : ?>
                <?php if ($selectedC == $p['category_id'] || $selectedC == null) : ?>
                    <div class="product-card">
                        <div class="product-title">
                        <h1><?= $p['name'];  ?></h1>
                        </div>
                        <img src="<?= $p['url'];  ?>" alt="<?= $p['name'];  ?>">
                        <h1><?= $p['price'];  ?>,- Kč</h1>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>