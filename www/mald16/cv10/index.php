<?php require __DIR__ . "/inc/head.php" ?>

<style>
    .products-wrapper {
        display: flex;
        margin: 20px 0;
        flex-wrap: wrap;
    }

    .products-wrapper>.card {
        margin: 30px;
    }
</style>

<?php
require __DIR__ . "/db/db.php";

$stmt = $pdo->prepare("SELECT * FROM cv10_items ORDER BY item_id DESC");
$stmt->execute();
$products = $stmt->fetchAll();

// require __DIR__ . "/display-errors.php";


// if (isset($_POST) && !empty($_POST)) {
//     $email = htmlspecialchars($_POST["email"]);
//     $password = htmlspecialchars($_POST["password"]);

//     $errors = [];

//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         array_push($errors, "E-mailová adresa není validní!");
//     }

//     // if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
//     //     array_push($errors, "Heslo musí mít alespoň 8 znaků, musí obsahovat alespoň jeden velký znak a alespoň jednu číslici #safetyFirst.");
//     // }

//     if (empty($errors)) {
//         // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//         $stmt = $pdo->prepare("SELECT * FROM cv10_users WHERE email = :email");
//         $stmt->bindValue(":email", $email, PDO::PARAM_STR);
//         $stmt->execute();
//         $result = $stmt->fetch();

//         $success = password_verify($password, $result["password"]);

//         if (!$success) {
//             array_push($errors, "E-mail nebo heslo se neshodují.");
//         }
//     }
// }


?>

<div class="container" style="width: 60%; margin: 0 auto; margin-top: 100px">
    <h1>Produkty</h1>

    <?php if (isset($_SESSION) && $_SESSION["role"] >= 2) : ?>
        <a class="btn btn-primary mb-3" href="create-item.php">Vytvořit produkt</a>
    <?php endif ?>

    <?php if (isset($_GET) && !empty($_GET["login"])) : ?>
        <div class="alert alert-success" role="alert">
            <strong>Přihlášení proběhlo v pořádku.</strong>
        </div>
    <?php endif ?>
    <div class="products-wrapper">
        <?php foreach ($products as $product) : ?>
            <div class="card" style="width: 350px; height: min-content;">
                <img class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;" src="<?php echo $product["img"]; ?>" alt="<?php echo $product["name"]; ?> photo">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $product["price"]; ?>$</h6>
                    <p class="card-text"><?php echo $product["description"]; ?></p>
                    <?php if (isset($_SESSION) && $_SESSION["role"] >= 2) : ?>
                        <a href="edit-item.php?item_id=<?php echo $product["item_id"] ?>" class="btn btn-outline-primary">Upravit</a>
                        <a href="delete-item.php?item_id=<?php echo $product["item_id"] ?>" class="btn btn-outline-secondary">Vymazat</a>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require __DIR__ . "/inc/foot.php" ?>