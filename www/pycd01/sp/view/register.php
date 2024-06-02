<?php
include '../controller/CustomersDB.php';
$errors = [];

const TRIM_CHARS = ' \n\r\t\v\x00';

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name'], TRIM_CHARS));
    $email = htmlspecialchars(trim($_POST['email'], TRIM_CHARS));
    $phone = htmlspecialchars(trim($_POST['phone'], TRIM_CHARS));
    $password = htmlspecialchars(trim($_POST['password'], TRIM_CHARS));
    $passwordC = htmlspecialchars(trim($_POST['passwordC'], TRIM_CHARS));

    $phone = str_replace(' ', '', $phone);
	
    $errors = validateUser($name, $email, $phone, $password, $passwordC);

    if (count($errors) == 0) {
        $customer = new Customers(0, $name, $email, $phone, password_hash($password, PASSWORD_DEFAULT));
        $customerDB = new CustomersDB();
        $customerDB->create($customer);
        setcookie("email", $email, time() + 3600);
        header('Location: ./main.php');
        exit();
    }
}

function validateUser($name, $email, $phone, $password, $passwordC)
{
    $errors = [];
    if (empty($name) || strlen($name) < 3 || strlen($name) > 30 || is_numeric($name) || !preg_match('/^([A-Z][a-z]+)\s([A-Z][a-z]+)$/', $name)) {
        array_push($errors, 'Vyplňte jméno ve tvaru "Jan Novák"');
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Vyplňte email');
    }
    if (empty($phone) || !preg_match('/^\d{9}$/', $phone)) {
    	array_push($errors, 'Vyplňte tel. č. ve tvaru "111 222 333"');
    }
    if (empty($password)  || strlen($password) < 8 || strlen($password) > 30 || is_numeric($password)) {
        array_push($errors, 'Vyplňte heslo. alespoň 8 znaků');
    } else {
        if ($password != $passwordC) {
            array_push($errors, 'Hesla se neshodují');
        }
    }
    return $errors;
}
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
    <main class="register">
        
        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <a href="./main.php"><button id="secondary-button" type="button">Zpět</button></a>
        <div class="register-content">
        <h1>Registrace</h1>
            <?php if (isset($_POST)) : ?>
                <?php foreach ($errors as $e) : ?>
                    <div class="alert alert-danger"><?php echo $e ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">
                <label>Jméno:</label>
                <br>
                <input class="form-control" name="name" type="text" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>E-mail:</label>
                <br>
                <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Telefonní číslo:</label>
                <br>
                <input class="form-control" name="phone" type="tel" value="<?php echo isset($phone) ? $phone : '' ?>">
            </div>
            <div class="form-group">
                <label>Heslo:</label>
                <br>
                <input class="form-control" name="password" type="password" value="<?php echo isset($password) ? $password : '' ?>">
            </div>
            <div class="form-group">
                <label>Potvrzení hesla:</label>
                <br>
                <input class="form-control" name="passwordC" type="password" value="<?php echo isset($passwordC) ? $passwordC : '' ?>">
            </div>
            <button id="primary-button" type="submit">Registrovat</button>
        </div>
    </form>
    </main>
<?php require __DIR__ . '/incl/footer.php'; ?>
