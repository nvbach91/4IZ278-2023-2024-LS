<?php
require __DIR__ . '/include/init.php';
require_once __DIR__ . '/db/UsersDB.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userDB = new UsersDB();
    $user = $userDB->findByEmail($email);

    if ($user) {
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Incorrect password.";
        }
    } else {
        $errors[] = "Email not found.";
    }
}
?>

<?php require __DIR__ . '/include/header.php'; ?>

<div class="container">
    <h2 class="mt-5">Login</h2>
    <form action="./login.php" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
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
