<?php
require __DIR__ . "/db/db.php";
session_start();

$products = [];
if (isset($_SESSION["cart"])) {
    if (count($_SESSION["cart"]) > 0) {
        $_SESSION["cart"] = array_values($_SESSION["cart"]);
        $placeholders = implode(',', array_fill(0, count($_SESSION["cart"]), '?'));
        $sql = "SELECT * FROM cv08_goods WHERE good_id IN ($placeholders)";
        $stmt = $db->prepare($sql);

        foreach ($_SESSION["cart"] as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
        }

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error executing statement: " . $e->getMessage();
            return;
        }

        $uniqueProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productsById = array_reduce($uniqueProducts, function ($carry, $product) {
            $carry[$product['good_id']] = $product;
            return $carry;
        }, []);

        foreach ($_SESSION["cart"] as $id) {
            if (isset($productsById[$id])) {
                $products[] = $productsById[$id];
            }
        }
    }
}




include __DIR__ . "/inc/head.php";
?>
<main style="min-height: 100vh;">
    <div style="width: 60%; margin: 50px auto;">
        <div style="margin-left: 30px;">
            <h1>Košík</h1>
            <a href="index.php" style="text-decoration: underline;">Nakoupit další produkty</a>
        </div>
        <div class="products-wrapper">
            <?php foreach ($products as $product) : ?>
                <div class="card" style="width: 18rem; height: min-content;">
                    <img class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;" src="<?php echo $product["img"]; ?>" alt="<?php echo $product["name"]; ?> photo">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $product["price"]; ?>$</h6>
                        <p class="card-text"><?php echo $product["description"]; ?></p>

                        <a href="remove-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-danger">Odebrat</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) == 0) : ?>
            <div class="alert alert-warning" role="alert" style="margin-left: 30px;">
                <strong> Košík je prázdný.
                </strong><a href="index.php" style="color: inherit; text-decoration: underline; cursor: pointer">Vrátit se na hlavní stránku.</a>
            </div>
        <?php endif ?>
    </div>
</main>
<?php include __DIR__ . "/inc/foot.php" ?>