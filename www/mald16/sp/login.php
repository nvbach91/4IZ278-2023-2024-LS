<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php include __DIR__ . "/inc/head.php"; ?>
<?php require_once __DIR__ . "/logic/validate.php" ?>
<?php require_once __DIR__ . "/db/User.php" ?>


<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST) && !empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    $errors = [];

    if (!validateEmail($email)) {
        array_push($errors, "E-mailová adresa '$email' není validní.");
    }

    if (!validateStr($password)) {
        array_push($errors, "Heslo nesmí být prázdné nebo delší než 255 znaků.");
    }

    if (empty($errors)) {
        $User = new User($email);

        $existingUser = $User->getUser();

        if ($existingUser && $existingUser["password"] != null && $existingUser["name"] != null) {
            $success = password_verify($password, $existingUser["password"]);

            if ($success) {
                $_SESSION["logged-in"] = true;
                $_SESSION["user-email"] = $email;
                $_SESSION["user-name"] = $existingUser["name"];
                $_SESSION["sm"] = 2;
                header('Location: ' . "index.php");
                exit();
            } else {
                array_push($errors, "E-mail nebo heslo se neshodují.");
            }
        } else {
            array_push($errors, "Tento uživatel zatím neexistuje.");
        }
    }
}
?>

<h1>Login</h1>
<hr>
<div class="text-muted">Ještě nemáš účet? <a href="register.php">Registruj se zde</a>.</div>
<br>

<?php require __DIR__ . "/logic/messages.php"; ?>
<?php require __DIR__ . "/logic/errors.php" ?>

<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input required type="email" class="form-control" placeholder="michal.jackson@gmail.com" name="email" value="<?php echo !empty($_POST["email"]) ? $_POST["email"] : "" ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Heslo</label>
        <input required type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Přihlásit se</button>
</form>

<?php include __DIR__ . "/inc/foot.php" ?>