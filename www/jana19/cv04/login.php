
<?php

// konstanta __DIR__ 
var_dump(__DIR__);

require __DIR__ . '/utils.php';

// pokud je ve složce utils
// require __DIR__ . '/utils/utils.php';
// ošetření proti jinému zápisu na jiných OS
// require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

if (!empty($_POST)) {
    // mame data neboli formulář byl odeslán pomocí metody POST
    $email =  htmlspecialchars(trim($_POST['email'])); 
    $password =  htmlspecialchars(trim($_POST['password']));

    $errors = [];
    // validace
    // PS: vím, že nastrčit tam <b> takhle není stoprocentně korektní a na reálných projektech by se to muselo provést jinak
    //  tady mi šlo pouze o to, aby bylo na první pohled vidět, co jsou ty dotažené hodnoty – lépe se to kontroluje 
    if (strlen($name) < 3) {
        array_push($errors, "<b>$name</b> is not valid – must have 3 or more characters!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "<b>$email</b> is not a valid email!");
    }

    if (strlen($password) < 3) {
        array_push($errors, "<b>Password</b> is not valid – must have 3 or more characters!");
    }

    if (strlen($password) !== strlen($passwordRepeat)) {
        array_push($errors, "<b>Passwords</b> do not match!");
    }

    if (checkUserExists('./admin/users.db', $email) == false) {
        array_push($errors, 'You are not registered');
    }

    if (count($errors) == 0) {
        if (authenticate('./admin/users.db', $email, $password) == false) {
                array_push($errors, 'Wrong password!');
            }
        else {
            $successMessage = 'Thank you for logging in!';
        }
    }
}
?>

<?php include './includes/head.php'; //import statické části html souboru 
?>
<form>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>"> <!-- pokud je uloženo do proměnné, tak se použije. Jinak vypíše prázdný string -->
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>"> <!-- ternální operátor - zkracený if-else -->
    </div>
    <div class="form-group">
        <label>Password*</label>
        <input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>"> 
    <button class="btn btn-primary" type="submit">Submit</button>
    <div class="form-group">
        <label>Repeat Password*</label>
        <input class="form-control" name="password-repeat" value="<?php echo isset($passwordRepeat) ? $passwordRepeat : '' ?>"> 
    <button class="btn btn-primary" type="submit">Submit</button>
</form>

<?php include './includes/foot.php'; //import statické části html souboru 
?>