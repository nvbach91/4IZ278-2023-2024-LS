<?php
require_once __DIR__ . '/../db/UserDatabase.php';

$usersDB = new UsersDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailCount = $usersDB->readUsersCountEmails($email);

    if ($emailCount > 0) {
        echo "Error: Could not register. This email has already been registered. Proceed to the Login Page to log in.";
    } else {
        $result = $usersDB->createUserLocal($email, $password);
        if ($result) {
            echo "Registered successfully! \n Please proceed to Log In.";
            //header("Location: ../index.php");
        } else {
            echo "Error: Could not register.";
        }
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


        <input class="btn btn-secondary" type="submit" value="Register!">
    </form>
    <br>
</main>