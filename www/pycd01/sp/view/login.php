<?php 
include_once '../controller/CustomersDB.php';
$errors = [];
const TRIM_CHARS = ' \n\r\t\v\x00';

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email'], TRIM_CHARS));
    $password = htmlspecialchars(trim($_POST['password'], TRIM_CHARS));

    $customersDB = new CustomersDB();
    $customers = $customersDB->readAll();
    $customer = null;
    foreach ($customers as $c) {
        if ($c['email'] == $email) {
            $customer = $c;
        }
    }
    
    if ($customer == null) {
        array_push($errors, "Email není registrovaný");
    } else {
        if (!password_verify($password, $customer["password"])) {
            array_push($errors, "Nesprávné heslo");
        }
    }

    if (count($errors) == 0) {
        setcookie("email", $email, time() + 3600);
        setcookie("privilege", $user['privilege'], time() + 3600);
        header('Location: ./main.php');
        exit();
    }
}
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
    <section class="login">
        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <a href="./main.php"><button id="secondary-button" type="button">Zpět</button></a>
            <div class="login-content">
            <h1>Přihlášení</h1>
            <?php if (isset($_POST)) : ?>
                <?php foreach ($errors as $e) : ?>
                    <div class="alert alert-danger"><?php echo $e ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">
                <label>E-mail:</label>
                <br>
                <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Heslo:</label>
                <br>
                <input class="form-control" name="password" type="password" value="<?php echo isset($password) ? $password : '' ?>">
            </div>
            <button id="primary-button" type="submit">Přihlásit</button>
            </div>
        </form>

    </section>
    <?php require __DIR__ . '/incl/footer.php'; ?>
