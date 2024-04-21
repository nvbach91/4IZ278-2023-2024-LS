<?php
require __DIR__ . "/db/db.php";

// require __DIR__ . "/logic/display-errors.php";

require __DIR__ . "/logic/require-login.php";
require __DIR__ . "/logic/allowed-roles.php";
allowedRoles([2, 3]);


if (isset($_GET["item_id"])) {

    $stmt = $pdo->prepare("SELECT * FROM cv10_items WHERE item_id = :item_id");
    $stmt->bindParam(":item_id", $_GET["item_id"], PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();
    $product = $products[0];

    $errors = [];
    if (count($products) != 0) {
        try {
            $stmnt = $pdo->prepare("DELETE FROM cv10_items WHERE item_id = :item_id;");
            $stmnt->bindValue(':item_id', $_GET["item_id"], PDO::PARAM_INT);

            $stmnt->execute();
            $success = true;
        } catch (PDOException $e) {
            $errorMessage = "Chyba v záznamu do databáze: " . $e->getMessage();
            array_push($errors, $errorMessage);
        }
    } else {
        $errorMessage = "Produkt nebyl nalezen.";
        array_push($errors, $errorMessage);
    }
}
?>

<?php include __DIR__ . "/inc/head.php"; ?>

<main style="height: 100vh;">
    <div style="width: 60%; margin: 50px auto;">
        <h1>Výmaz produktu</h1>
        <br>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Vyskytly se následující problémy:</strong>
                <?php foreach ($errors as $err) : ?>
                    <div><?php echo $err ?></div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">
                <strong>Produkt "<?php echo $product["name"] ?>" byl úspešně vymazán. <a href="index.php" style="color: inherit; text-decoration: underline; cursor: pointer">Vrátit se na hlavní stránku.</a></strong>
            </div>
        <?php endif ?>
    </div>
</main>
<?php include __DIR__ . "/inc/foot.php" ?>