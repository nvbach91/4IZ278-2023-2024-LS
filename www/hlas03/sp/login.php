<?php
require __DIR__ . '/include/init.php';
require_once __DIR__ . '/validators/UserValidator.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';

    $validator = new UserValidator();
    $errors = $validator->validateLogin($email, $password);

    if (empty($errors)) {
        $userDB = new UsersDB();
        $user = $userDB->findByEmail($email);
        
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8');
        $_SESSION['last_name'] = htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8');
        $_SESSION['email'] = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
        $_SESSION['phone'] = htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8');
        $_SESSION['role_id'] = $user['role_id'];
        header('Location: index.php');
        exit;
    }
}
?>

<?php require __DIR__ . '/include/header.php'; ?>

<div class="container">
    <h2 class="mt-5">Login</h2>
    <form action="./login" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="mt-3">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
