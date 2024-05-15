<?php

require __DIR__ . '/../classes/UsersDB.php';

$usersDB = new UsersDB();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $success = false;

    $users = $usersDB->findByEmail($email);

    if (!count($users) == 1) {
        array_push($errors, "Tento email není registrovaný!");
    } else {
        if (!password_verify($password, $users[0]['password'])) {
            array_push($errors, "Nesprávné heslo!");
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Zadejte správný formát emailu!");
    }

    if (strlen($password) < 3) {
        array_push($errors, "Heslo musí obsahovat alespoň 3 znaky!");
    }

    if (count($errors) == 0) {
        $success = true;
        setcookie("email", $email, time() + 60 * 60);
        setcookie("user_id", $users[0]['user_id'], time() + 60 * 60);
        setcookie("privilege", $users[0]['privilege'], time() + 60 * 60);
        header("Location: reservation-page.php");
        exit;
    }
}

?>


<div class="reservation-div">

    <h1>Přihlášení</h1>
    <hr class="legend">


    <div class="div-registration">
        <form class="form-register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Uživatelský email:</label><br>
            <input name="email" value="<?php echo (isset($email) && !$success) ? $email : '' ?>"><br>
            <label>Uživatelské heslo:</label><br>
            <input name="password" value="<?php echo (isset($password) && !$success) ? $password : '' ?>" type="password"><br>
            <button class="btn btn-primary btn-new" type="submit">Přihlásit se</button>
        </form>

        <div class="errors">
            <?php if (isset($errors)) {
                foreach ($errors as $error): ?>
                    <p><?php echo $error ?></p>
                <?php endforeach;
            } ?>
        </div>
    </div>

</div>