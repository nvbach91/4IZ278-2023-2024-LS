<?php
session_start();
require __DIR__ . '/../db/UsersDB.php';
?>
<?php
$usersDB = new UsersDB();
$users = $usersDB->find();

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $username = stripcslashes($username);
    $email = stripcslashes($email);
    $password = stripcslashes($password);
    $confirm = stripcslashes($confirm);

    //check for used username
    $existing_username = $usersDB->checkUsedUsername($username);
    if ($existing_username != null) {
        $errors['username'] = 'Takhle se tu už někdo jmenuje';
    }

    //check for used email
    $existing_email = $usersDB->checkUsedEmail($email);
    if ($existing_email != null) {
        $errors['email'] = 'Tenhle email tu už někdo používá';
    }

    // check for invalid passwords
    if (strlen($password) < 8 || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password)) {
        $errors['password'] = 'Heslo musí mít aspoň 8 znaků, 1 velké a 1 malé písmeno';
    }
    if ($password !== $confirm) {
        $errors['confirm'] = 'Hesla se neshodují';
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //vlozime usera do databaze
        $usersDB->createUserNormal(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);

        //získat údaje o userovi
        $user = $usersDB->getUserInfoByEmail($email);

        //přihlásit usera
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['user_email'] = $email;

        header('Location: /../index.php');
    }
}
?>
<?php require __DIR__ . '/../preset/header.php' ?>
<main class="signin-container popup">
    <h2>Registrace</h2>
    <form class="form-signin" method="POST">
        <input type="name" name="username" class="input-text" placeholder="Přezdívka" required>
        <?php if (!empty($errors['username'])): ?>
            <small>
                <i><b><?php echo $username ?></b></i> se tu už někdo jmenuje
            </small>
        <?php endif; ?>
        <input type="email" name="email" class="input-text" placeholder="Email" required>
        <?php if (!empty($errors['email'])): ?>
            <small>
                <i><b><?php echo $email ?></b></i> tu už někdo používá
            </small>
        <?php endif; ?>
        <input type="password" name="password" id="password" class="input-text" placeholder="Heslo" required>
        <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
        <?php if (!empty($errors['password'])): ?>
            <small>
                <?php echo array_key_exists('password', $errors) ? 'Heslo musí mít aspoň 8 znaků, 1 velké a 1 malé písmeno' : ''; ?>
            </small>
        <?php endif; ?>
        <input type="password" name="confirm" class="input-text" placeholder="Potvrdit heslo" required>
        <?php if (!empty($errors['confirm'])): ?>
            <small>
                <?php echo array_key_exists('confirm', $errors) ? 'Hesla se neshodují' : ''; ?>
            </small>
        <?php endif; ?>

        <button id="form-submit" type="submit">Registrovat</button>
    </form>
    <a href="SignIn.php" class='signin-already'>Máš už účet? Přihlaš se!</a>

    <p class='signin-or'>
    <p class='signin-or-longer'>----</p>------------------------ nebo ------------------------<p
        class='signin-or-longer'>----</p>
    </p>
    <button class="button-login" id="main-button-login" onclick="fb_login();">
        <i class="fa-brands fa-facebook-f"></i>
        <p>Registrovat přes Facebook</p>
    </button>

    <button class="button-login" id="main-button-login2" onclick="oauth2SignIn();">
        <i class="fa-brands fa-google google-icon"></i>
        <p>Registrovat přes Google</p>
    </button>
</main>
<?php require __DIR__ . '/../preset/footer.php' ?>