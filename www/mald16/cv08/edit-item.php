<?php

require __DIR__ . "/db/db.php";

$success = false;

if (isset($_GET["good_id"])) {
    $DBitem = $db->prepare("SELECT * FROM cv08_goods WHERE good_id = :good_id");
    $DBitem->bindParam(":good_id", $_GET["good_id"], PDO::PARAM_INT);
    $DBitem->execute();
    $products = $DBitem->fetchAll();
    $product = $products[0];

    $errors = [];

    if (!empty($products)) {
        // Produkt existuje v DB

        if (!empty($_POST) && isset($_GET["good_id"])) {
            $name = htmlspecialchars(trim($_POST["name"]));
            $price = htmlspecialchars(trim($_POST["price"]));
            $descr = htmlspecialchars(trim($_POST["descr"]));
            $imgURL = htmlspecialchars(trim($_POST["img_url"]));

            $errors = [];

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

            if (strlen($descr) < 5) {
                $errorMessage = "Popis produktu musí mít alespoň 5 znaků.";
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
                    $stmnt = $db->prepare("UPDATE cv08_goods SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :good_id;");

                    $stmnt->bindValue(':name', $name, PDO::PARAM_STR);
                    $stmnt->bindValue(':price', $price, PDO::PARAM_STR);
                    $stmnt->bindValue(':description', $descr, PDO::PARAM_STR);
                    $stmnt->bindValue(':img', $imgURL, PDO::PARAM_STR);
                    $stmnt->bindValue(':good_id', $_GET["good_id"], PDO::PARAM_INT);

                    $stmnt->execute();
                    $success = true;
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
            <div class="form-group">
                <label>Název</label>
                <input value="<?php echo !empty($products) ? ($success ? $_POST["name"] : $product["name"]) : "" ?>" type="text" class="form-control" name="name" placeholder="Nike Air Force 1">
            </div>
            <div class="form-group">
                <label>Cena</label>
                <input value="<?php echo !empty($products) ? ($success ? $_POST["price"] : $product["price"]) : "" ?>" type="text" class="form-control" name="price" placeholder="300,90">
            </div>
            <div class="form-group">
                <label>Popis</label>
                <input value="<?php echo !empty($products) ? ($success ? $_POST["descr"] : $product["description"]) : "" ?>" type="text" class="form-control" name="descr" placeholder="Je to naprosto úžasný produkt. Buy it!">
            </div>
            <div class="form-group">
                <label>Odkaz obrázku</label>
                <input value="<?php echo !empty($products) ? ($success ? $_POST["img_url"] : $product["img"]) : "" ?>" type="text" class="form-control" name="img_url" placeholder="https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg">
            </div>

            <button type="submit" class="btn btn-primary">Upravit</button>
        </form>
    </div>
</main>
<?php include __DIR__ . "/inc/foot.php" ?>