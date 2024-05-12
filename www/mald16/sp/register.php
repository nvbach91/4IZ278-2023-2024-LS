<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php include __DIR__ . "/inc/head.php"; ?>
<?php require_once __DIR__ . "/logic/validate.php" ?>
<?php require_once __DIR__ . "/db/User.php" ?>

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    $errors = [];

    if (!validateStr($name)) {
        array_push($errors, "Jméno nesmí být prázdné nebo delší než 255 znaků.");
    }

    if (!validateEmail($email)) {
        array_push($errors, "E-mailová adresa '$email' není validní.");
    }

    if (!validateStr($password)) {
        array_push($errors, "Heslo nesmí být prázdné nebo delší než 255 znaků.");
    }

    // if (!validatePassword($password)) {
    //     array_push($errors, "Heslo musí mít alespoň 8 znaků, musí obsahovat alespoň jeden velký znak a alespoň jednu číslici.");
    // }

    if (empty($errors)) {

        $User = new User($email);

        $existingUser = $User->getUser();

        if ($existingUser && $existingUser["password"] == null && $existingUser["name"] == null) {
            $success = $User->updateNonregisteredUser($name, $password, $email);
        } else if (!$existingUser) {
            $success = $User->registerUser($name, $email, $password);
        } else {
            array_push($errors, "Tento uživatel už existuje.");
        }

        if (empty($errors)) {
            if ($success) {
                $_SESSION["logged-in"] = true;
                $_SESSION["user-email"] = $email;
                $_SESSION["user-name"] = $name;
                $_SESSION["sm"] = 1;
                header('Location: ' . "index.php");
                exit();
            } else {
                array_push($errors, "Registrace nebyla úspěšná.");
            }
        }
    }
}


?>

<h1>Registrace</h1>
<hr>
<div class="text-muted">Již máš účet? <a href="login.php">Přihlaš se zde</a>.</div>
<br>
<?php require __DIR__ . "/logic/errors.php" ?>

<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Celé jméno</label>
        <input required type="text" class="form-control" placeholder="Michal Jackson" name="name" value="<?php echo !empty($_POST["name"]) ? $_POST["name"] : "" ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input required type="email" class="form-control" placeholder="michal.jacksongmail.com" name="email" value="<?php echo !empty($_POST["email"]) ? $_POST["email"] : "" ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Heslo</label>
        <input required type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Zaregistrovat se</button>
</form>

<?php include __DIR__ . "/inc/foot.php" ?>