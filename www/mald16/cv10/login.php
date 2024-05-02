<?php require __DIR__ . "/inc/head.php" ?>

<?php
require __DIR__ . "/db/db.php";


if (isset($_POST) && !empty($_POST)) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "E-mailová adresa není validní!");
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM cv10_users WHERE email = :email");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();

        $success = password_verify($password, $result["password"]);

        if (!$success) {
            array_push($errors, "E-mail nebo heslo se neshodují.");
        } else {
            session_start();
            $_SESSION["logged-in"] = true;
            $_SESSION["role"] = $result["privilege"];
            header('Location: ' . "index.php?login=success");
        }
    }
}


?>

<div class="container" style="width: 60%; margin: 0 auto; margin-top: 100px">
    <h1>Přihlášení</h1>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Vyskytly se následující chyby:</strong><br>
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <?php if (isset($_GET) && !empty($_GET["logout"])) : ?>
        <div class="alert alert-success" role="alert">
            <strong>Odhlášení proběhlo v pořádku.</strong>
        </div>
    <?php endif ?>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input required type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Heslo</label>
            <input required type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Přihlásit se</button>
    </form>
</div>
<?php require __DIR__ . "/inc/foot.php" ?>