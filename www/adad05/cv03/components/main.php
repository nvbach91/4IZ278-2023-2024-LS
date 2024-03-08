<?php
// echo $_SERVER['PHP_SELF'];
if (!empty($_POST)) {
    // pokud proměnná POST není prázdná, dostali jsme data a můžeme s nimi pracovat
    // funkce htmlspecialchars() nahradí znaky html entitami, což je velmi důležité
    // funkce trim() odstraní z levé a pravé strany nadbytečné bílé znaky
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $title = htmlspecialchars(trim($_POST['title']));
    $amount = htmlspecialchars(trim($_POST['amount']));

    // nyní nastavíme validaci; errory budeme sbírat do pole
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email \"$email\" is not valid!");
    }

    if ($gender == '') {
        array_push($errors, "Please, choose a gender!");
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "Avatar URL \"$avatar\" is not valid!");
    }

    if (strlen($title) < 3) {
        array_push($errors, "Deck title \"$title\" not valid. Title must have at least 3 characters!");
    }

    if (!preg_match('/^([A-Z]\\w* ){1,2}([A-Z]\\w*)$/', $name)) {
        array_push($errors, "Name \"$name\" is not valid! You can include middle name but use capital letters! Example: Josef Kajetán Tyl");
    }

    if (!preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)) {
        array_push($errors, "Phone \"$phone\" is not valid! Example: +420 123 456 789");
    }

    if ($amount < 1 || !is_numeric($amount)) {
        array_push($errors, "Number of cards \"$amount\" is not valid! Must be a non negative integer!");
    }

    if (count($errors) == 0) {
        $successMessage = 'Thank you for your registration!';
        // mail(
        //     'adad05@vse.cz',
        //     'Registration successful',
        //     '<h1>Thank you for your registration!</h1>',
        //     [
        //         'MIME-Version: 1.0',
        //         'Content-type: text/html',
        //         'From: adad05@vse.cz',
        //         'Reply-to: adad05@vse.cz',
        //         'X-Mailer: PHP/' . phpversion(),
        //     ]
        // );
    }
}
?>
<div class="wrapper">
    <?php if (isset($successMessage)) : ?>
        <h2><?php echo $successMessage; ?></h2>
        <img src="<?php echo $avatar; ?>" alt="No image found">
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
            <div class="label"><label>Full name (First letters must be capital)*</label></div>
            <div class="input"><input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>"></div>
        </div>
        <div class="form-group">
            <div class="label"><label>Gender*</label></div>
            <div class="input">
                <select name="gender" class="select">
                    <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value="">Choose</option>
                    <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
                    <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="label"><label>Email (adress@example.com)*</label></div>
            <div class="input"><input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>"></div>
        </div>
        <div class="form-group">
            <div class="label"><label>Phone (+420 123 456 789)*</label></div>
            <div class="input"><input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>"></div>
        </div>
        <div class="form-group">
            <div class="label"><label>Avatar URL (URL must be valid)*</label></div>
            <div class="input"><input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>"></div>
        </div>
        <div class="form-group">
            <div class="label"><label>Title of the deck*</label></div>
            <div class="input"><input class="form-control" name="title" value="<?php echo isset($title) ? $title : '' ?>"></div>
        </div>
        <div class="form-group">
            <div class="label"><label>Number of cards in the deck*</label></div>
            <div class="input"><input class="form-control" name="amount" value="<?php echo isset($amount) ? $amount : '' ?>"></div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>