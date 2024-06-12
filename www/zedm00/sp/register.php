<?php require_once __DIR__ . '/db/CustomerDB.php'; ?>
<?php


$customerDB = new CustomerDB;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashed_password = hash('sha256', $password);
    $year = htmlspecialchars(trim($_POST['year']));

    try {
        $response = $customerDB->createCustomer($name, $email, $hashed_password, $year);
        $_SESSION['customer_id'] = $response;
        $_SESSION['name'] = $email;
        header("Location: index.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

if (isset($_SESSION['customer_id'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrace zákazníka</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 bg-light rounded px-5 py-3 mt-5">
    <h2 class="my-4">Registrace zákazníka</h2>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="username">Jméno</label>
            <input type="text" id="username" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">E-mail*</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Heslo*</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dob">Narození</label>
            <input type="date" id="dob" name="year" class="form-control" required>
        </div>
        <input type="submit" value="Registrovat" class="btn btn-primary">
        <div class="mt-2">Již máte účet? <a href="index.php">Přihlásit se</a></div>
        <div>Chcete se registrovat jako inzerent? <a href="admin_register.php">Klikněte zde</a></div>

    </form>
</div>

</body>
</html>


