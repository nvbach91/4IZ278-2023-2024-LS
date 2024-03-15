<?php

require __DIR__ . '/utils/utils.php';
define('TITLE', 'Login');

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $errors = [];

    $user = authenticate($email, $password);
    if (is_null($user)) {
        array_push($errors, "Invalid email or password");
    } else {
        $successMessage = "You are logged in as " . $user['name'];
    }
} else if (!empty($_GET)) {
    $email = htmlspecialchars(trim($_GET['email']));

    if (isset($email)) {
        $successMessage = "You were successfully registered. You can now log in.";
    }
}
?>

<?php include './includes/head.php'; ?>
<h1>Login</h1>
<main>
    <form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" type="password">
        </div>
        <button class="btn btn-primary" type="submit">Log in</button>
    </form>
    <p><a href="index.php">&larr; back to main page</a></p>
</main>
<?php include './includes/foot.php'; ?>
