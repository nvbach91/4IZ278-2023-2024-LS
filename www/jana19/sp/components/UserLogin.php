<?php
require_once __DIR__ . '/../db/UserDatabase.php';
session_start();

$usersDB = new UsersDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    
        $result = $usersDB->readUserByEmail($email);
        $existing_user = $result ? $result[0] : null;

        var_dump($existing_user);

        if (isset($existing_user['password']) && password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['idUser'];
            $_SESSION['user_email'] = $existing_user['email'];

            header('Location: ../sp/index.php');
            exit;
        } else {
            header('HTTP/1.1 401 Unauthorized');
            exit('Invalid login');
        }
    
}
?>
<main class="container">
    <br>
    <form action="" method="POST">
        <label for="name">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="name">Password:</label>
        <input type="text" id="password" name="password" required><br><br>


        <input class="btn btn-secondary" type="submit" value="Log in!">
    </form>
    <br>
</main>