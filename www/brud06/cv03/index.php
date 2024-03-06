<?php
//echo $_SERVER['PHP_SELF'];
if (!empty($_POST)) {
    ##mame data neboli formular byld odeslan pomoci metody POST
    //var_dump($_POST);
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $deck = htmlspecialchars(trim($_POST['deck']));
    $numberOfCards = htmlspecialchars(trim($_POST['numberOfCards']));

    $errors = [];

    //user@domain.realm
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //echo "$email not valid";
        array_push($errors, "$email is not valid email");
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        //echo "$avatar not valid";
        array_push($errors, "$avatar is not valid avatarURL");
    }
    if (strlen($name) < 3) {
        //echo "$name must have 3 or more characters";
        array_push($errors, "$name: Name must have 3 or more characters");
    }
    if (empty($gender)) {
        array_push($errors, "Gender is required");
    }
    if (!preg_match("/^(\+420)?[1-9][0-9]{8}$/", $phone)) {
        //echo "$phone is not valid phone number. e.g. +420123456789 or 123456789";
        array_push($errors, "$phone is not valid phone number e.g. +420123456789 or 123456789");
    }
    if (strlen($deck) < 2) {
        array_push($errors, "$deck: Deck must have 2 or more characters");
    }
    if (!filter_var($numberOfCards, FILTER_VALIDATE_INT) || $numberOfCards < 1 || $numberOfCards > 52) {
        //echo "$deck is not valid deck";
        array_push($errors, "$numberOfCards is not valid number of cards");
    }
    if (count($errors) == 0) {
        $successMessage = 'Thank you for your registration';
        /*mail(
            'brud06@vse.cz',
            'Registration successful',
            '<h1>Thank you for your registration</h1>',
        );*/
    }
} else {
    ## nemame data
}
?>

<?php include './includes/head.php'; ?>
<main class="main">
    <h1>Lab03 homework</h1>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Registration</h1>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
            <?php if (isset($successMessage)) : ?>
                <div class="alert alert-success">
                    <h2><?php echo $successMessage; ?></h2>
                </div>
            <?php endif; ?>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p class="form error"><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="gender">
            <label>Gender*</label>
            <select name="gender">
                <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value="">Select...</option>
                <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
            <?php if (isset($avatar) && $avatar != '') : ?>
                <img src="<?php echo $avatar; ?>" alt="Avatar">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Deck*</label>
            <input class="form-control" name="deck" value="<?php echo isset($deck) ? $deck : '' ?>">
        </div>
        <div class="form-group">
            <label>Number of cards*</label>
            <input class="form-control" name="numberOfCards" value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>
<?php include './includes/foot.php'; ?>