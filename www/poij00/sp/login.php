
<?php 
session_start();
const DB_HOST = 'localhost';
const DB_DATABASE = 'fitness_eshop';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

$db = new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



if (!empty($_POST)) {

    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1'); 
    $stmt->execute([
        'username' => $username
    ]);
    $existing_user = $stmt->fetchAll()[0];

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['username'] = $existing_user['username'];

        header('Location: index.php');
        exit;
    } else {
        header('HTTP/1.1 401 Unauthorized');
        exit('Invalid login');
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
        <header>
            <nav class="navbar-menu">
            <div class="navbar-menu-left">
                    <div class="eshop-icon"><a href="./index.php"><i class="fa-solid fa-dumbbell"></i></a></div>
                    <div class="eshop-name"><a>FitFactory</a></div>
                </div>
                <div class="navbar-menu-right">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-solid fa-user"></i>
                </div>
            </nav>
        </header>
        <main class="login-container">
            <p class="login-title">Přihlášení</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
                <label for="username" class="login-label">Uživatelské jméno</label>
                <input type="text" name="username" id="username" class="login-input">
                <label for="password" class="login-label">Heslo</label>
                <input type="password" name="password" id="password" class="login-input">
                <button type="submit">Přihlásit se</button>
            </form>
            <div class="login-register">Nemáte ještě účet? <a href="signup.php" class="register-link">Registrujte se!</a></div>
        </main>

</body>
</html>