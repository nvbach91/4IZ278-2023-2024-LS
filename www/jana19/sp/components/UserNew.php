<?php
require_once __DIR__ . '/../db/UserDatabase.php';

$usersDB = new UsersDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "<b>$email</b> is not a valid email!");
    }

    if (strlen($password) < 4) {
        array_push($errors, "<b>$password</b> is not valid – must have 4 or more characters!");
    }

    if (count($errors) == 0) {
        $emailCount = $usersDB->readUsersCountEmails($email);

        var_dump($emailCount);

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
}
?>
<main class="container">
    <br>
    <?php if (!empty($errors)) : ?>
        <div class="form-errors">
            <?php foreach ($errors as $error) : ?>
                <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
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