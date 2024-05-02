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

    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        array_push($errors, "Heslo musí mít alespoň 8 znaků, musí obsahovat alespoň jeden velký znak a alespoň jednu číslici #safetyFirst.");
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO cv10_users (email, password, privilege) VALUES (:email, :password, 1)");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $success = $stmt->execute();

        if (!$success) {
            array_push($errors, "Nastala chyba při registraci uživatele.");
        } else {
            session_start();
            $_SESSION["role"] = 1;
            $_SESSION["logged-in"] = true;
            header('Location: ' . "index.php?login=success");
        }
    }
}


?>

<div class="container" style="width: 60%; margin: 0 auto; margin-top: 100px">
    <h1>Registrace</h1>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Vyskytly se následující chyby:</strong><br>
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <?php if ($success) : ?>
        <div class="alert alert-success" role="alert">
            <strong>Uživatel <?php echo $email ?> byl úspěšně vytvořen!</strong>
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
        <button type="submit" class="btn btn-primary">Registrovat</button>
    </form>
</div>
<?php require __DIR__ . "/inc/foot.php" ?>