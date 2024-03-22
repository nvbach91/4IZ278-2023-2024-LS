<?php
require_once './components/header.php';
require_once './functions.php';


$email = $_GET['email'] ?? '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email)) {
        $errors['email'] = 'Please enter your email.';
    }

    if (empty($password)) {
        $errors['password'] = 'Please enter your password.';
    }

    if (empty(array_filter($errors))) {
        $result = authenticate($email, $password);
        if ($result['success']) {
            echo '<div class="alert alert-success">Login successful!</div>';
        } else {
            $errors['login'] = $result['message'];
        }
    }
}

function authenticate($email, $password) {
    $user = fetchUser($email);
    if ($user) {
        if ($user['password'] === $password) {
            return ['success' => true];
        } else {
            return ['success' => false, 'message' => 'Incorrect password.'];
        }
    } else {
        return ['success' => false, 'message' => 'User not found.'];
    }
}
?>

<div class="container">
    <h2>Login</h2>
    <?php if (!empty($_GET['email'])): ?>
        <div class="alert alert-success">Registration successful. Please login.</div>
    <?php endif; ?>
    <form class="form-signin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label>Email*</label>
            <input type="email" class="form-control <?php echo (!empty($errors['email'])) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <span class="invalid-feedback"><?php echo htmlspecialchars($errors['email'] ?? ''); ?></span>
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input type="password" class="form-control <?php echo (!empty($errors['password'])) ? 'is-invalid' : ''; ?>" name="password">
            <span class="invalid-feedback"><?php echo htmlspecialchars($errors['password'] ?? ''); ?></span>
        </div>
        <?php if (!empty($errors['login'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errors['login']); ?></div>
        <?php endif; ?>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
</div>

<?php
require_once './components/footer.php';
?>