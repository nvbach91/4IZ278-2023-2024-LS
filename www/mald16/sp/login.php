<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Přihlášení" ?>

<?php include __DIR__ . "/inc/head.php"; ?>
<?php require_once __DIR__ . "/logic/validate.php" ?>
<?php require_once __DIR__ . "/db/User.php" ?>


<?php

require "./auth/pre-auth.php";


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
<div class="d-grid gap-2">
    <a class="btn btn-outline-primary" href="<?php echo $request_to ?>">
        <svg style="margin-bottom: 3px; margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
        </svg>

        Přihlásit se přes Google
    </a>
    <b style="margin: 20px auto">nebo:</b>
</div>


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
<div class="text-muted my-3">Ještě nemáš účet? <a href="register.php">Registruj se zde</a>.</div>

<?php include __DIR__ . "/inc/foot.php" ?>