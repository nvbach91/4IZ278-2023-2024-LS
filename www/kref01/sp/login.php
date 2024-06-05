<?php include './includes/guestHead.php';?>

<?php
require_once './classes/UsersDB.php';

session_start();
$_SESSION = array();
$usersDB = new UsersDB();

$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!empty($password)) {
        $user = $usersDB->getUserByEmail($email);

        $hashed_password = hash('sha256', $password);
        if ($user && ($hashed_password === $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            if (isset($_COOKIE['last_visited'])) {
                $last_visited = $_COOKIE['last_visited'];
                header("Location: $last_visited");
            } else {
                header("Location: ./profile.php");
            }
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please enter a valid email and password.";
    }
}
?>

<?php if (isset($_GET['registered']) && $_GET['registered'] == 'success'): ?>
    <div class="success-banner">Your registration process was successful.</div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error-banner"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="login-container">
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="./registration.php">Register here</a></p>
</div>

<?php include './includes/foot.php'; ?>
