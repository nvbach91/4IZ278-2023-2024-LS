<?php
session_start();
require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // zajimavost: mysql porovnani retezcu je case insensitive, pokud dame select na NECO@DOMENA.COM, najde to i zaznam neco@domena.com
    // viz http://dev.mysql.com/doc/refman/5.0/en/case-sensitivity.html

    $stmt = $db->prepare('SELECT * FROM users WHERE username LIKE BINARY :username LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'username' => $username
    ]);
    $existing_user = @$stmt->fetchAll()[0];

    if (!$existing_user) {
        $errors['username'] = 'Takhle se tu ještě nikdo nejmenuje';
    }

    else if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['user_username'] = $existing_user['username'];

        //header('Location: index.php');
        //exit;
    } else {
        $errors['password'] = 'Špatné heslo';
    }
}
?>


<?php require __DIR__ . '/preset/header.php' ?>
<main class="signin-container popup">
    <h2>Přihlášení</h2>
    <form class="form-signin" method="POST">
        <input type="username" name="username" class="input-text" placeholder="Přezdívka" required autofocus>
        <?php if (!empty($errors['username'])): ?>
            <small>
                <i><b><?php echo $username ?></b></i> se tu ještě nikdo nejmenuje
            </small>
        <?php endif; ?>
        <input type="password" id='password' name="password" class="input-text" placeholder="Heslo" required>
        <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
        <?php if (!empty($errors['password'])): ?>
            <small>
                Špatné heslo
            </small>
        <?php endif; ?>

        <button id="form-submit" type="submit">Přihlásit</button>
    </form>
    <a href="signup.php" class='signin-already'>Nemáš účet? Založ si ho!</a>

    <p class='signin-or'><p class='signin-or-longer'>----</p>------------------------ nebo ------------------------<p class='signin-or-longer'>----</p></p>
    <button class="button-login" id="main-button-login" onclick="fb_login();">
        <i class="fa-brands fa-facebook-f"></i>
        <p>Přihlásit přes Facebook</p>
    </button>
    <button class="button-login" id="main-button-login2" onclick="oauth2SignIn();">
        <i class="fa-brands fa-google google-icon"></i>
        <p>Přihlásit přes Google</p>
    </button>
</main>

<?php require __DIR__ . '/preset/footer.php' ?>