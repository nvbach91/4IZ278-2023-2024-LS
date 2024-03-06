<?php
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $alertMessages = [];
    $alertType = 'alert-danger';
    $invalidInputs = [];
    $submittedForm = true;
    if (!$name) {
        $alertMessages[] = 'Please enter your name';
        $invalidInputs[] = 'name';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alertMessages[] = 'Please use a valid email';
        $invalidInputs[] = 'email';
    }
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        $alertMessages[] = 'Please use a valid phone number';
        $invalidInputs[] = 'phone';
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $alertMessages[] = 'Please use a valid URL for your avatar';
        $invalidInputs[] = 'avatar';
    }
    if (!in_array($gender, ['N', 'F', 'M'])) {
        $alertMessages[] = 'Please select a gender';
        $invalidInputs[] = 'gender';
    }
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $successMessage = 'Woohoo! You have successfully signed up!';
        mail(
            $email,
            'Registration confirmation',
            '<h1>Thank you for signing up!</h1>'
        );
    }
}
?>

<?php include './includes/head.php'; ?>
<?php if (!empty($alertMessages)): ?>
    <?php foreach ($alertMessages as $alertMessage): ?>
        <div>
            <p class="form-error"><?php echo $alertMessage; ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php if (isset($successMessage)): ?>
    <div>
        <p class="form-success"><?php echo $successMessage; ?></p>
    </div>
<?php endif; ?>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="alert alert-danger">Show alert only after submission and change alert type accordingly</div>
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
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
    </div>
    <div class="form-group">
        <label>Gender*</label>
        <select class="form-control" name="gender">
            <option value="N"<?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>>Neutral</option>
            <option value="F"<?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
            <option value="M"<?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
<?php include './includes/foot.php'; ?>