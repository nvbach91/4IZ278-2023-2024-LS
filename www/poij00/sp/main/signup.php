<?php require '../database/UsersDB.php'; ?> 

<?php
if (!empty($_POST)) {

$username = htmlspecialchars(trim($_POST['username']));
$email = htmlspecialchars(trim($_POST['email']));
$pwd = htmlspecialchars(trim($_POST['password']));
$pwdRepeat = htmlspecialchars(trim($_POST['passwordrpt']));

$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

$errors = [];

if (empty($username)) {
    array_push($errors, 'Vložte validní uživatelské jméno!');
}

if (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
    array_push($errors, 'Vložte validní uživatelské jméno!');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, 'Vložte validní emailovou adresu!');
}

if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{6,}$/', $pwd)) {
    array_push($errors, 'Heslo musí být dlouhé alespoň 6 znaků a obsahovat 1 velké písmeno a číslo!');
}

if ($pwd !== $pwdRepeat) {
    array_push($errors, 'Hesla se neshodují!');
}

if ($users->userExists($username, $email) === true) {
    array_push($errors, 'Uživatel s tímto username nebo emailem již je registrován.');
}

    if (count($errors) == 0) {
        $data = array (
            'username' => $username,
            'email' => $email,
            'password' => $hashedPwd
        );
        $users->create($data);
        echo "<div class='registration-success' style='text-align: center;'>";
        echo "<p>Byli jste úspěšně registrováni!</p>";
        echo "<a href='login.php'><button>Pokračovat k přihlášení</button></a>";
        echo "</div>"; 
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
    <link rel="stylesheet" href="../style2.css">
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
                    <?php 
                        if(isset($_SESSION["user_id"])) {
                    ?>
                    <a href="./cart.php" class="cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                    <?php
                        if (isAdmin($loggedInUser) == false) {
                            echo "<a href='./wishList.php' class='wishlist-icon'><i class='fa-solid fa-heart'></i></a>";
                        }
                    ?>
                    <a href="./orders.php"><i class="fa-solid fa-user"></i></a>
                    <a href="../components/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                    <?php
                        } else {
                    ?>
                    <a href="./cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="./login.php"><i class="fa-solid fa-user"></i></a>
                    <?php
                        }
                    ?>
                </div>
            </nav>
        </header>
        <main class="login-container">
            <p class="login-title">Registrace</p>
            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                <?php foreach($errors as $error): ?>
                    <p class="form-error"><?php echo $error; ?></p>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" class="login-form">
                <label for="username" class="login-label">Uživatelské jméno</label>
                <input type="text" name="username" id="username" class="login-input">
                <label for="username" class="login-label">Email</label>
                <input type="text" name="email" id="username" class="login-input">
                <label for="password" class="login-label">Heslo</label>
                <input type="password" name="password" id="password" class="login-input">
                <label for="passwordrpt" class="login-label">Zopakovat heslo</label>
                <input type="password" name="passwordrpt" id="passwordrpt" class="login-input">
                <button type="submit" name="submit">Registrovat se</button>
            </form>
        </main>
        <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Kontaktujte nás</h3>
                <p>Email: info@fitfactory.cz</p>
                <p>Telefon: +420 733 222 455</p>
                <p>Adresa: Francouzska 2576/18, 120 00 Praha</p>
            </div>
            <div class="footer-column">
                <h3>Rychlé odkazy</h3>
                <ul>
                    <li><a href="">O nás</a></li>
                    <li><a href="">Obchod</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Kontakt</a></li>
                    <li><a href="">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Sledujte nás</h3>
                <div class="social-icons">
                    <a href="" target="_blank">Facebook</a>
                    <a href="" target="_blank">Twitter</a>
                    <a href="" target="_blank">Instagram</a>
                    <a href="" target="_blank">YouTube</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Newsletter</h3>
                <form class="newsletter">
                    <input type="email" placeholder="Váš email">
                    <button type="submit">Přihlásit se</button>
                </form>
            </div>
        </div>
        <p>&copy; 2024 FitFactory. Všechna práva vyhrazena.</p>
    </footer>

</body>
</html>