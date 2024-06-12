<?php
require_once __DIR__ . '/db/AdvertizerDB.php';
$advertizerDB = new AdvertizerDB;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashed_password = hash('sha256', $password);
    try {
        $response = $advertizerDB->findAdvertizerByUsername($email);
        if ($response['password'] != $hashed_password) {
            throw new Exception("Špatné heslo");
        }
        $_SESSION['advertizer_id'] = $response["id"];
        $_SESSION['name'] = $response["username"];
        header("Location: admin_index.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_SESSION['advertizer_id'])) {
    header("Location: admin_index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Přihlášení inzerenta</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 bg-warning rounded px-5 py-3 mt-5">
    <h2 class="my-4">Přihlášení inzerenta</h2>
    <form action="admin_login.php" method="post">

        <div class="form-group">
            <label for="email">Uživatelské jméno</label>
            <input id="email" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Heslo*</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <input type="submit" value="Přihlásit se" class="btn btn-primary">
        <div class="mt-2">Ještě nemáte účet? <a href="admin_register.php">Registrovat</a></div>
        <div>Chcete se přihlásit jako zákazník? <a href="index.php">Klikněte zde</a></div>

    </form>
</div>


</body>
</html>


