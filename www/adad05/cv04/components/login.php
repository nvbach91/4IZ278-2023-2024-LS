<?php

require '../components/utils.php';
$fileName = '../users.txt';

// // write to file
// file_put_contents($fileName, 'Mezinárodní den žen');

// // append to file
// file_put_contents($fileName, PHP_EOL . "\nMezinárodní den žen", FILE_APPEND);

// // write to file
// file_put_contents($fileName, "1\n2\n3\n4\n5\n6\n7\n8");

// // read file
// $fileContent = file_get_contents($fileName);

// // rozdělíme do pole podle oddělovače nového řádku
// $lines = explode("\n", $fileContent);
// var_dump($lines);

// // odebere prvek z pole od offsetu a počet prvků
// array_splice($lines, 2, 1);
// var_dump($lines);

// $newContent = implode(PHP_EOL, $lines);
// var_dump($newContent);
// file_put_contents($fileName, $newContent);


// echo $_SERVER['PHP_SELF'];
if (!empty($_POST)) {
    // pokud proměnná POST není prázdná, dostali jsme data a můžeme s nimi pracovat
    // funkce htmlspecialchars() nahradí znaky html entitami, což je velmi důležité
    // funkce trim() odstraní z levé a pravé strany nadbytečné bílé znaky
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // nyní nastavíme validaci; errory budeme sbírat do pole
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email \"$email\" is not valid!");
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password not valid. Password must have at least 8 characters!");
    }

    if (!checkUserExists($fileName, $email)) {
        array_push($errors, "Entered email is not registered!");
    } elseif (!attemptAuthentication($fileName, $email, $password)) {
        array_push($errors, "Incorrect password!");
    }

    if (count($errors) == 0) {
        $successMessage = 'Login successful!';
    }
}

if (isset($_GET['email']) && @$_GET['ref'] === 'registration') {
    $email = $_GET['email'];
}

?>
<div class="wrapper">
    <h1>Login to your account!</h1>
    <?php if (isset($successMessage)) : ?>
        <h2><?php echo $successMessage; ?></h2>
    <?php endif ?>
    <?php if (!empty($errors)) : ?>
        <div class="errors">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!-- action je umístění, kam se data z formuláře umístí -->

    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <div class="label"><label>Email (adress@example.com)*</label></div>
            <div class="input"><input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>"></div>
        </div>
        <div class="form-group">
            <div class="label"><label>Password*</label></div>
            <div class="input"><input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>"></div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

    <div class="go-back">
        <a href="../">Go back to main page!</a>
    </div>
</div>