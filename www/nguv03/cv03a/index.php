<?php
if (!empty($_POST)) {
    // mame data neboli formular byl odeslan pomoci metody POST
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    // echo $name;
    $errors = [];
    // user.name@domain.realm
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "$email is not valid!");
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "$avatar is not valid!");
    }
    if (strlen($name) < 3) {
        array_push($errors, "$name must have 3 or more characters!");
    }
    if (!preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)) {
        array_push($errors, "$phone is not a valid phone number. e.g. +420 123 456 789");
    }

    if (count($errors) == 0) {
        $successMessage = 'Thank you for your registration';
        mail(
            $email,
            'Registration successful',
            '<h1>Thank you for your registration</h1>',
            [
                'MIME-Version: 1.0',
                'Content-type: text/html',
                'From: nguv03@vse.cz',
                'Reply-to: nguv03@vse.cz',
                'X-Mailer: PHP/' . phpversion(),
            ],
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($successMessage)): ?>
        <h2><?php echo $successMessage; ?></h2>
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
                <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value=""></option>
                <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</body>

</html>