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
    $name =  htmlspecialchars(trim($_POST['name'])); // special chars escapuje znaky na html entity
    $email =  htmlspecialchars(trim($_POST['email'])); //trim ořeže bílé znaky
    $phone =  htmlspecialchars(trim($_POST['phone']));
    $avatar =  htmlspecialchars(trim($_POST['avatar']));
    $gender =  $_POST['gender'];
    $cardDeck = htmlspecialchars(trim($_POST['cardDeck']));
    $cardAmmount = htmlspecialchars(trim($_POST['cardAmmount']));
    $password =  htmlspecialchars(trim($_POST['password']));

    $errors = [];
    // validace
    // PS: vím, že nastrčit tam <b> takhle není stoprocentně korektní a na reálných projektech by se to muselo provést jinak
    //  tady mi šlo pouze o to, aby bylo na první pohled vidět, co jsou ty dotažené hodnoty – lépe se to kontroluje 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "<b>$email</b> is not a valid email!");
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "<b>$avatar</b> is not a valid URL!");
    }
    if (strlen($name) < 3) {
        array_push($errors, "<b>$name</b> is not valid – must have 3 or more characters!");
    }
    
    if (!preg_match('/^(\\+\\d{2,3})( ?\\d{3}){3}$/', $phone)) {
        array_push($errors, "<b>$phone</b> is not valid phone number: e.g. +420 123 456 789");
    }

    if (strlen($cardDeck) < 3) {
        array_push($errors, "<b>$cardDeck</b> is not valid – must have 3 or more characters!");
    }

    if ($cardAmmount < 25) {
        array_push($errors, "<b>$cardAmmount</b> – the ammount must be at least 25 cards!");
    }

    if (strlen($password) < 3) {
        array_push($errors, "<b>$password</b> is not valid – must have 3 or more characters!");
    }

    if (checkUserExists('./admin/users.db', $email)) {
        array_push($errors, 'You are already registered');
    }


    if (count($errors) == 0) {
        $successMessage = 'Thank you for your registration!';
        // mail(
        //     'jana19@vse.cz', 'Success message', '<h1>Thanks for your registration.</h1>',
        //     [
        //         'MIME-Version: 1.0',
        //         'Content-type: text/html',
        //         'From: jana19@vse.cz',
        //         'Reply-to: jana19@vse.cz',
        //         'X-Mailer: PHP/' . phpversion(), 
        //     ],
        // );

        // uložení obsahu do souboru
        $userRecord = implode(';', [$name, $email, $phone, $avatar, $gender, $cardDeck, $cardAmmount, $password]);
        appendFileContent('./admin/users.db', $userRecord);
        header("./login.php");
        exit();
    }
}
?>
<?php include './includes/head.php'; //import statické části html souboru 
?>

<?php if (isset($successMessage)) : ?>
    <h2><?php echo $successMessage; ?></h2>
<?php endif; ?>
<?php if (!empty($errors)) : ?>
    <div class="form-errors">
        <?php foreach ($errors as $error) : ?>
            <p class="form-error"><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif ?>
<div class="avatar-display">
    <label>Your avatar image: </label><br>
    <img alt="your avatar" width="200" src="<?php echo isset($avatar) ? $avatar : '' ?>">
</div>
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
        <label>Phone*</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
    </div>
    <div class="form-group">
        <label>Gender*</label>
        <select name="gender">
            <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value="">-</option>
            <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
            <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label>Card Deck*</label>
        <input class="form-control" name="cardDeck" value="<?php echo isset($cardDeck) ? $cardDeck : '' ?>">
    </div>
    <div class="form-group">
        <label>Ammount of Cards in Deck*</label>
        <input class="form-control" type="number" step="25" name="cardAmmount" value="<?php echo isset($cardAmmount) ? $cardAmmount : 0 ?>">
    </div>
    <div class="form-group">
        <label>Password*</label>
        <input class="form-control" name="password" value="<?php echo isset($password) ? '*****' : '' ?>"> 
    <button class="btn btn-primary" type="submit">Submit</button>
</form>

<?php include './includes/foot.php'; //import statické části html souboru 
?>