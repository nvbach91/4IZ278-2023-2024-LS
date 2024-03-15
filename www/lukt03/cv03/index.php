<?php
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deckName = htmlspecialchars(trim($_POST['deckName']));
    $deckSize = htmlspecialchars(trim($_POST['deckSize']));
    $gender = htmlspecialchars(trim($_POST['gender']));

    $errors = [];
    if (strlen($name) < 3) {
        array_push($errors, "Name must have at least 3 characters");
    }
    if (strlen($email) == 0) {
        array_push($errors, "An email address is required");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "'$email' is not a valid email address");
    }
    if (strlen($phone) == 0) {
        array_push($errors, "A phone number is required");
    } else if (!preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)) {
        array_push($errors, "'$phone' is not a valid Czech phone number");
    }
    if (strlen($avatar) == 0) {
        array_push($errors, "An avatar URL is required");
    } else if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "'$avatar' is not a valid avatar URL");
    }

    if (count($errors) == 0) {
        $successMessage = 'Thank you for your registration';
    }
}
?>

<?php include './includes/head.php'; ?>
<h1>Registration form</h1>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div class="form-group">
        <label>Phone*</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    <div class="form-group">
        <label>Deck name</label>
        <input class="form-control" name="deckName" value="<?php echo isset($deckName) ? $deckName : ''; ?>">
    </div>
    <div class="form-group">
        <label>Cards in the deck</label>
        <input class="form-control" name="deckSize" type="number" min="0" value="<?php echo isset($deckSize) ? $deckSize : ''; ?>">
    </div>
    <div class="form-group">
        <label>Gender</label>
        <select class="form-control" name="gender">
            <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value=''>Prefer not to answer</option>
            <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value='F'>Female</option>
            <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value='M'>Male</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
<?php include './includes/foot.php'; ?>