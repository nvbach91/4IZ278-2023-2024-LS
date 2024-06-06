<?php
session_start();
require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    /*$username = stripcslashes($username);
    $email = stripcslashes($email);
    $password = stripcslashes($password);
    $confirm = stripcslashes($confirm);*/

    //check for used username
    $stmt = $db->prepare('SELECT * FROM users WHERE username LIKE BINARY :username LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'username' => $username
    ]);
    $existing_user = @$stmt->fetchAll();

    if ($existing_user != null) {
        $errors['username'] = 'Takhle se tu už někdo jmenuje';
    }

    //check for used email
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll();

    if ($existing_user != null) {
        $errors['email'] = 'Tenhle email tu už někdo používá';
    }

    // check for invalid passwords
    if (strlen($password) < 8 || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password)) {
        $errors['password'] = 'Heslo musí mít aspoň 8 znaků, 1 velké a 1 malé písmeno';
    }
    if ($password !== $confirm) {
        $errors['confirm'] = 'Hesla se neshodují';
    }

    // TODO PRO STUDENTY osetrit vstupy, email a heslo jsou povinne, atd.
    // TODO PRO STUDENTY jde se prihlasit prazdnym heslem, jen prototyp, pouzit filtry
    // $password = md5($_POST['password']); #chybi salt

    // $password = hash("sha256" , $password); #chybi salt

    // viz http://php.net/manual/en/function.password-hash.php
    // salt lze generovat rucne (nedoporuceno), nebo to nechat na php, ktere salt rovnou pridat do hashovaneho hesla

    /**
     * We just want to hash our password using the current DEFAULT algorithm.
     * This is presently BCRYPT, and will produce a 60 character result.
     *
     * Beware that DEFAULT may change over time, so you would want to prepare
     * By allowing your storage to expand past 60 characters (255 would be product)
     */
    // dalsi moznosti je vynutit bcrypt: PASSWORD_BCRYPT
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //vlozime usera do databaze
        $stmt = $db->prepare('INSERT INTO users(username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
        // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)

        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $stmt->execute([
            'email' => $email
        ]);
        $user_id = @$stmt->fetchAll()[0];

        $_SESSION['user_id'] = $user_id['user_id'];
        $_SESSION['user_username'] = $user_id['username'];
        $_SESSION['user_email'] = $email;

        header('Location: index.php');
    }
}
?>

<?php require __DIR__ . '/preset/header.php' ?>
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
    <a href="signin.php" class='signin-already'>Máš už účet? Přihlaš se!</a>

    <p class='signin-or'>
    <p class='signin-or-longer'>----</p>------------------------ nebo ------------------------<p
        class='signin-or-longer'>----</p>
    </p>
    <button class="button-login" id="main-button-login" onclick="fb_login();">
        <i class="fa-brands fa-facebook-f"></i>
        <p>Registrovat přes Facebook</p>
    </button>

    <!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>-->

    <button class="button-login" id="main-button-login2" onclick="oauth2SignIn();">
        <i class="fa-brands fa-google google-icon"></i>
        <p>Registrovat přes Google</p>
    </button>
</main>
<?php require __DIR__ . '/preset/footer.php' ?>