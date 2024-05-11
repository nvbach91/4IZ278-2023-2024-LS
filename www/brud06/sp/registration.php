<?php
require_once 'db/UsersDB.php';
$userDB = new UsersDB();

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "$email is not valid email");
    }
    if ($userDB->checkUserExist($email)) {
        array_push($errors, "User with email $email already exists");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must have 8 or more characters");
    }
    if ($password != $confirmPassword) {
        array_push($errors, "Passwords do not match");
    }
    if (count($errors) == 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = ['email' => $email, 'password' => $hashedPassword, 'privilege' => 1];
        $registerResult = $userDB->createUser($user);
        if ($registerResult === true) {
            $successMessage = 'You have successfully registered';
            header("Location: login.php?email=$email&message=" . urlencode($successMessage));
            exit;
        } else {
            array_push($errors, "User with email $email already exists");
        }
    }
} else {
    ## nemame data
}
?>

<?php include './includes/head.php'; ?>
<main class="main">
    <h1>Name TBD</h1>
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
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <div class="form-group">
            <label>Confirm Password*</label>
            <input type="password" class="form-control" name="confirmPassword" value="<?php echo isset($confirmPassword) ? $confirmPassword : '' ?>">
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>
<?php include './includes/foot.php'; ?>