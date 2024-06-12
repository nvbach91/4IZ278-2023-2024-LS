<?php require_once __DIR__ . '/db/AdvertizerDB.php';
$advertizerDB = new AdvertizerDB;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashed_password = hash('sha256', $password);
    $address = htmlspecialchars(trim($_POST['address']));
    $description = htmlspecialchars(trim($_POST['description']));

    try {
        $response = $advertizerDB->createAdvertizer($username, $hashed_password, $name, $address, $description);
        $_SESSION['advertizer_id'] = $response;
        $_SESSION['name'] = $username;
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
    <title>Registrace inzerenta</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 bg-warning rounded px-5 py-3 mt-5">
    <h2 class="my-4">Registrace inzerenta</h2>
    <form action="admin_register.php" method="post">
        <div class="form-group">
            <label for="username">Jméno</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Uživatelské jméno*</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Heslo*</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="username">Adresa</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="form-group">
            <label for="username">Popisek</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <input type="submit" value="Registrovat" class="btn btn-primary">
        <div class="mt-2">Již máte účet? <a href="admin_login.php">Přihlásit se</a></div>
        <div>Chcete se registrovat jako zákanzník? <a href="register.php">Klikněte zde</a></div>

    </form>
</div>


</body>
</html>


