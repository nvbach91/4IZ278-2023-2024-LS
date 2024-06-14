<?php
require_once __DIR__ . '/db/CustomerDB.php';

$customerDB = new CustomerDB;
session_start();

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashed_password = hash('sha256', $password);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Špatný formát emailu: ' . $email;
    }

    if (empty($errors)) {
        try {
            $response = $customerDB->findCustomerByEmail($email);
            if ($response['password'] != $hashed_password) {
                $errors[] = 'Špatné heslo.';
            } else {
                $_SESSION['customer_id'] = $response["id"];
                $_SESSION['name'] = $response["email"];
                header("Location: index.php");
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

}


if (!empty($errors)) {
    echo '<div class="alert alert-danger gap-3">';
    foreach ($errors as $error) {
        echo '<div>' . $error . '</div>';
    }
    echo '</div>';
}


if ($_SESSION['customer_id']) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Přihlášení zákazníka</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 bg-light rounded px-5 py-3 mt-5">
    <h2 class="my-4">Přihlášení zákazníka</h2>
    <form action="index.php" method="post">

        <div class="form-group">
            <label for="email">E-mail*</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Heslo*</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <input type="submit" value="Přihlásit se" class="btn btn-primary">
        <div class="mt-2">Ještě nemáte účet? <a href="register.php">Registrovat</a></div>
        <div>Chcete se přihlásit jako inzerent? <a href="admin_login.php">Klikněte zde</a></div>

    </form>
</div>

<?php //require '../hotreloader.php'; ?>
</body>
</html>


