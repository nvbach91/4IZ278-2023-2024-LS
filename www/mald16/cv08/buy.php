<?php

require __DIR__ . "/db/db.php";

session_start();

$error = false;

if (isset($_GET["good_id"])) {
    $itemExistsQuery = $db->prepare("SELECT COUNT(*) FROM cv08_goods WHERE good_id = :good_id");
    $itemExistsQuery->bindParam(":good_id", $_GET["good_id"], PDO::PARAM_INT);
    $itemExistsQuery->execute();

    $itemCount = $itemExistsQuery->fetchColumn();

    if ($itemCount > 0) {
        // Produkt existuje v DB

        if (!isset($_SESSION['cart'])) {
            $_SESSION['items'] = array();
        }

        $_SESSION['cart'][] = $_GET["good_id"];
        header('Location: ' . "cart.php");
    } else {
        // Produkt neexistuje v DB
        $error = true;
    }
}



?>
<?php if ($error) : ?>
    <?php include __DIR__ . "/inc/head.php"; ?>
    <main style="height: 100vh;">
        <div style="width: 60%; margin: 50px auto;">
            <div class="alert alert-danger" role="alert">
                <strong> Produkt číslo <?php echo $_GET["good_id"] ?> neexistuje.
                </strong><a href="index.php" style="color: inherit; text-decoration: underline; cursor: pointer">Vrátit se na hlavní stránku.</a>
            </div>
        </div>
    </main>
    <?php include __DIR__ . "/inc/foot.php" ?>
<?php endif ?>