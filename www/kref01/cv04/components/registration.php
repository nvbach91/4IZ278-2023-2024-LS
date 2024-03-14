<?php require './utils.php'; ?>

<?php
$filePath = "./users.db";
$successMessage = "";
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    $errors = [];

    if (strlen($name) < 3) {
        array_push($errors, "Your name must have 3 or more characters");
    }
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Please use a valid email");
    }
    if ($password != $confirmPassword) {
        array_push($errors, "Your passwords must be identical");
    }
    if (strlen($password) < 3) {
        array_push($errors, "Your password must have 3 or more characters");
    }
    if (count($errors) == 0) {
        if (registerNewUser($filePath, $errors, $name, $email, $password)) {
            mail(
                $email,
                'Registration Successful',
                'Thank you for your registration!'
            );
            header("Location: login.php?email=" . $email);
        }
        else {
            array_push($errors, "This email is already taken");
        }
    }
}
?>

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="headline">Form validation example</div>
    <div class="headline">Registration form</div>
    <?php if (! empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error;?></p>
            <?php endforeach;?>
        </div>
    <?php endif;?>
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" name="name" placeholder="e.g. Homer Simpson" value="<?php echo isset($name) ? $name : '' ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" placeholder="e.g. example@gmail.com" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" type="password" name="password" value="">
    </div>
    <div class="form-group">
        <label>Repeat Password</label>
        <input class="form-control" type="password" name="confirmPassword" value="">
    </div>
    <button class="btn btn-primary" type="submit">
        <p>Submit</p>
    </button>
</form>
