<?php

require_once 'db/Users.php';

$message = null;
$error = true;
$usersDb = new UsersDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    do {
        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['retypepassword'])) {
            $message = 'Please fill in all fields';
            break;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $retypepassword = $_POST['retypepassword'];

        if (strlen(($username)) < 3) {
            $message = 'Username is too short';
            break;
        }

        if (strlen(($password)) < 3) {
            $message = 'Password is too short';
            break;
        }

        if ($password !== $retypepassword) {
            $message = 'Passwords do not match';
            break;
        }

        $existedUser = $usersDb->getUser($username, null);

        if ($existedUser == null){
            $message = 'Username already taken';
            break;
        }

        $existedUser = $usersDb->getUser(null, $email);

        if ($existedUser == null){
            $message = 'Email already used';
            break;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $usersDb->create([$username, $email, $passwordHash]);

        setcookie('name', $username, time() + 3600, "/");
        $error = false;
        $message = 'Registration successful';
        header( "refresh:1;url=index.php" );

    } while(0);

}
?>
<?php include __DIR__ . '/components/header.php' ?>
<form method="post" action="register.php" class="form">
    <?php if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
        Username: <input type="text" name="username"><br>
        Email: <input type="email" name="email"><br>
        Password: <input type="password" name="password"><br>
        Retype Password: <input type="password" name="retypepassword"><br>
        <input type="submit" value="Register">
    </div>
</form>
<?php include __DIR__ . '/components/footer.php' ?>