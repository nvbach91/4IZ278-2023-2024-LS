
<?php 

require '.' . DIRECTORY_SEPARATOR . 'utils.php';

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $deckName = htmlspecialchars(trim($_POST['deck']));
    $deckNumberOfCards = htmlspecialchars(trim($_POST['cards']));

    $errors = [];

    if (strlen($name) < 3) {
        array_push($errors, "Name must have 3 or more characters!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email has invalid email format!");
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "Avatar URL is not valid URL!");
    }
    if (!preg_match('/^(\+\d{1,3}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{3}$/', $phone)) {
        array_push($errors, "Phone has invalid phone number format. e.g. +420 345 676 876");
    }
    if (strlen($deckName) < 3) {
        array_push($errors, "Name of deck is not valid! Deck name must have 3 or more characters.");
    }
    if (intval($deckNumberOfCards) <= 0) {
        array_push($errors, "Number of cards in deck must be greater than 0!");
    }
    if (checkUserExist('./users.text', $email)) {
        array_push($errors, 'You are already registered');
    }

    if (strlen($password) < 5) {
        array_push($errors, "Password must have atleast 5 characters!");
    }

    if (count($errors) == 0) {
        $userRecord = implode(';', [$name, $email, $password, $phone, $avatar, $gender, $deckName, $deckNumberOfCards]);
        appendFileContent('./users.text', $userRecord);
        header('Location: http://localhost/cv01/ukoly/ukol04/login.php');
    }
}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php if (isset($successMessage)): ?>
        <div class="form-success">
            <h2><?php echo $successMessage; ?></h2>
        </div>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?> 
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
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
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value=""></option>
                <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
            </select>
        </div>
        <div class="form-group">
            <label>Deck name</label>
            <input class="form-control" name="deck" value="<?php echo isset($deckName) ? $deckName : ''; ?>">
        </div>
        <div class="form-group">
            <label>Number of cards in deck</label>
            <input class="form-control" name="cards" value="<?php echo isset($deckNumberOfCards) ? $deckNumberOfCards : ''; ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    <p><a class="button" href="./home.php">Back</a></p>
</body>
</html>