<?php
require_once './utils/utils.php';

$name = $email = $password = $confirm_password = '';
$filename = __DIR__ . '/database/users.db';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST, 'name'));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($name)) {
        $errors['name'] = 'Please enter your name';
    }

    if (empty($email)) {
        $errors['email'] = 'Please enter your email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email';
    }

    if (empty($password)) {
        $errors['password'] = 'Please enter a password';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (count($errors) === 0) {
        $registrationResult = registerNewUser($filename, $name, $email, $password);

        if ($registrationResult === 'Registration successful') {
            header('Location: login.php?email=' . $email . '&ref=registration');
            exit();
        } else {
            $errors['registration'] = $registrationResult;
        }
    }
}

?>

<?php include './includes/head.php'; ?>
<div class="container">
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1 class="text-center mb-4">Register</h1>
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control<?php if (isset($errors['name'])) echo ' is-invalid'; ?>" name="name"
                   value="<?php echo $name; ?>" required>
            <?php if (isset($errors['name'])): ?>
                <div class="invalid-feedback"><?php echo $errors['name']; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control<?php if (isset($errors['email'])) echo ' is-invalid'; ?>" type="email"
                   name="email" value="<?php echo $email; ?>" required>
            <?php if (isset($errors['email'])): ?>
                <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control<?php if (isset($errors['password'])) echo ' is-invalid'; ?>" type="password"
                   name="password" required>
            <?php if (isset($errors['password'])): ?>
                <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Confirm Password*</label>
            <input class="form-control<?php if (isset($errors['confirm_password'])) echo ' is-invalid'; ?>"
                   type="password" name="confirm_password" required>
            <?php if (isset($errors['confirm_password'])): ?>
                <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
            <?php endif; ?>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>
<?php include './includes/foot.php'; ?>