<?php

require __DIR__ . "/db/db.php";

// require __DIR__ . "/logic/display-errors.php";

require __DIR__ . "/logic/require-login.php";
require __DIR__ . "/logic/allowed-roles.php";
allowedRoles([2, 3]);

@session_start();

$success = false;

if (isset($_GET["item_id"])) {
    $stmt = $pdo->prepare("SELECT * FROM cv11_opt_items WHERE item_id = :item_id");
    $stmt->bindParam(":item_id", $_GET["item_id"], PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();

    $errors = [];
    $editClash = false;

    if (!empty($products)) {
        // Produkt existuje v DB
        $product = $products[0];

        // Pokud není nastavená session proměnná -> vložení aktuální timestamp z DB do session
        if (!isset($_SESSION["timestamp"])) {
            $_SESSION["timestamp"] = $product["timestamp"];
        } else if ($_SESSION["timestamp"] != $product["timestamp"]) {
            $errorMessage = "Někdo v mezičase upravil záznam. <a href='index.php' style='color: inherit'>Vrátit se zpět.</a>";
            array_push($errors, $errorMessage);
            $editClash = true;
        }

        if (!empty($_POST) && isset($_GET["item_id"])) {
            $name = htmlspecialchars(trim($_POST["name"]));
            $price = htmlspecialchars(trim($_POST["price"]));
            $imgURL = htmlspecialchars(trim($_POST["img_url"]));

            if (strlen($name) > 255) {
                $errorMessage = "Název produktu je příliš dlouhý.";
                array_push($errors, $errorMessage);
            } else if (strlen($name) < 5) {
                $errorMessage = "Název produktu musí mít alespoň 5 znaků.";
                array_push($errors, $errorMessage);
            }

            $normalizedPrice = str_replace(',', '.', $price);
            if (!preg_match('/^-?\d+(\.\d+)?$/', $normalizedPrice)) {
                $errorMessage = "Cena produktu není validní.";
                array_push($errors, $errorMessage);
            }

            if (!filter_var($imgURL, FILTER_VALIDATE_URL)) {
                if (strlen($imgURL) == 0) {
                    $errorMessage = "Adresa obrázku je prázdná.";
                    array_push($errors, $errorMessage);
                } else {
                    $errorMessage = "Adresa obrázku není validní.";
                    array_push($errors, $errorMessage);
                }
            }

            if (empty($errors)) {
                try {
                    $stmnt = $pdo->prepare("UPDATE cv11_opt_items SET name = :name, price = :price, img = :img WHERE item_id = :item_id;");

                    $stmnt->bindValue(':name', $name, PDO::PARAM_STR);
                    $stmnt->bindValue(':price', $price, PDO::PARAM_STR);
                    $stmnt->bindValue(':img', $imgURL, PDO::PARAM_STR);
                    $stmnt->bindValue(':item_id', $_GET["item_id"], PDO::PARAM_INT);

                    $stmnt->execute();
                    $success = true;
                    unset($_SESSION["timestamp"]);
                } catch (PDOException $e) {
                    $errorMessage = "Chyba v záznamu do databáze: " . $e->getMessage();
                    array_push($errors, $errorMessage);
                }
            }
        }
    } else {
        // Produkt neexistuje v DB
        $errorMessage = "Produkt nebyl nalezen.";
        array_push($errors, $errorMessage);
    }
}

?>


<?php include __DIR__ . "/inc/head.php"; ?>

<main style="height: 100vh;">
    <div style="width: 60%; margin: 50px auto;">

        <h1>Upravení produktu</h1>
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
                <strong>Produkt "<?php echo $name ?>" byl úspešně upraven. <a href="index.php" style="color: inherit; text-decoration: underline; cursor: pointer">Vrátit se na hlavní stránku.</a></strong>
            </div>
        <?php endif ?>
        <br>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="form-group mb-3">
                <label>Název</label>
                <input value="<?php echo !empty($products) ? ($success || $editClash ? $_POST["name"] : $product["name"]) : "" ?>" type="text" class="form-control" name="name" placeholder="Nike Air Force 1">
            </div>
            <div class="form-group mb-3">
                <label>Cena</label>
                <input value="<?php echo !empty($products) ? ($success || $editClash  ? $_POST["price"] : $product["price"]) : "" ?>" type="text" class="form-control" name="price" placeholder="300,90">
            </div>
            <div class="form-group mb-3">
                <label>Odkaz obrázku</label>
                <input value="<?php echo !empty($products) ? ($success || $editClash  ? $_POST["img_url"] : $product["img"]) : "" ?>" type="text" class="form-control" name="img_url" placeholder="https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg">
            </div>

            <button type="submit" class="btn btn-primary">Upravit</button>
        </form>
    </div>
</main>
<?php include __DIR__ . "/inc/foot.php" ?>