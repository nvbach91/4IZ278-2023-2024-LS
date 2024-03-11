<?php

require __DIR__ . '/utils/utils.php';
define('TITLE', 'Registration');

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $repeatPassword = htmlspecialchars($_POST['repeatPassword']);
    $errors = [];

    // form validation
    if (checkUserExists($email)) {
        array_push($errors, 'This email address is already registered');
    }
    if (strlen($name) < 3) {
        array_push($errors, "Name must have at least 3 characters");
    }
    if (strlen($email) == 0) {
        array_push($errors, "An email address is required");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "'$email' is not a valid email address");
    }
    if (strlen($password) < 8 /* more regex checks should be added in a real app */) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password != $repeatPassword) {
        array_push($errors, "Passwords don't match");
    }

    if (count($errors) == 0) {
        // try to perform registration
        if (registerNewUser($email, $name, $password)) {
            header('Location: login.php?email=' . $email);
        } else {
            array_push($errors, "There was an issue with your registration");
        }
    }
}
?>

<?php include './includes/head.php'; ?>
<h1>Registration</h1>
<main>
    <form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" type="password">
        </div>
        <div class="form-group">
            <label>Repeat password</label>
            <input class="form-control" name="repeatPassword" type="password">
        </div>
        <button class="btn btn-primary" type="submit">Register</button>
    </form>
    <p><a href="index.php">&larr; back to main page</a></p>
</main>
<?php include './includes/foot.php'; ?>
