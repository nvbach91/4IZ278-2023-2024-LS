<?php
require __DIR__ . "/db/db.php";

if (isset($_GET["good_id"])) {

    $DBitem = $db->prepare("SELECT * FROM cv08_goods WHERE good_id = :good_id");
    $DBitem->bindParam(":good_id", $_GET["good_id"], PDO::PARAM_INT);
    $DBitem->execute();
    $products = $DBitem->fetchAll();
    $product = $products[0];

    $errors = [];
    if (count($products) != 0) {
        try {
            $stmnt = $db->prepare("DELETE FROM cv08_goods WHERE good_id = :good_id;");
            $stmnt->bindValue(':good_id', $_GET["good_id"], PDO::PARAM_INT);

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