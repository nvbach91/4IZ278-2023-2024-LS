<?php

require __DIR__ . '/../classes/UsersDB.php';

$usersDB = new UsersDB();

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $success = false;

    $users = $usersDB->findByEmail($email);

    if (count(explode(" ", $name)) < 2) {
        array_push($errors, "Zadejte jméno i příjmení!");
    }

    if (!count($users) == 0) {
        array_push($errors, "Pod tímto emailem je již někdo registrovaný!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Zadejte správný formát emailu!");
    }

    if (strlen($password) < 3) {
        array_push($errors, "Heslo musí obsahovat alespoň 3 znaky!");
    }

    if (count($errors) == 0) {
        $success = true;
        $usersDB->createUser($name, $email, password_hash($password, PASSWORD_DEFAULT));
        header("Location: login-page.php");
        exit;
    }
}



?>


<div class="reservation-div">

    <h1>Registrace</h1>
    <hr class="legend">

    <div class="div-registration">
        <form class="form-register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Jméno a příjmení:</label><br>
            <input name="name" value="<?php echo (isset($name) && !$success) ? $name : '' ?>"><br>
            <label>Uživatelský email:</label><br>
            <input name="email" value="<?php echo (isset($email) && !$success) ? $email : '' ?>"><br>
            <label>Uživatelské heslo:</label><br>
            <input name="password" value="<?php echo (isset($password) && !$success) ? $password : '' ?>" type="password"><br>
            <button class="btn btn-primary btn-new" type="submit">Registrovat se</button>
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