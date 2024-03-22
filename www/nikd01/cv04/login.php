<?php
require_once './utils/utils.php';

$email = '';
$password = '';
$messages = [];
$database = __DIR__ . '/database/users.db';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $result = authenticate($database, $email, $password);

    if (isset($result['success'])) {
        $messages['success'] = $result['success'];
    } else if (isset($result['error'])) {
        $messages['error'] = $result['error'];
    }
}
?>

<?php include './includes/head.php'; ?>
<form method="POST" action="login.php" class="form-login">
    <h1 class="text-center mb-4">Login</h1>
    <div class="form-group">
        <label>Email*</label>
        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
    </div>
    <div class="form-group">
        <label>Password*</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php if (!empty($messages['success'])): ?>
    <p class="form-success"><?php echo $messages['success']; ?></p>
<?php endif; ?>
<?php if (!empty($messages['error'])): ?>
    <p class="form-error"><?php echo $messages['error']; ?></p>
    <a href="./index.php">Go to registration</a>
<?php endif; ?>
<?php include './includes/foot.php'; ?>
