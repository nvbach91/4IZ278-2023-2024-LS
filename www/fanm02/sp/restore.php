<?php

require_once 'db/Users.php';

$message = null;
$error = true;
$usersDb = new UsersDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    do {
        if(empty($_POST['username']) || empty($_POST['token'])) {
            $message = 'Please fill in both fields';
            break;
        }

        $username = $_POST['username'];
        $password = $_POST['token'];

        $registeredUser = $usersDb->getUser($username, $username);

        if($registeredUser == null){
            $message = 'No user was found under this username or email';
            break;
        }

        if(!password_verify($password, $registeredUser['passwordHash'])){
            $message = 'Wrong password';
            break;
        }

        setcookie('name', $username, time() + 3600, "/");
        $error = false;
        $message = 'Logged successfuly as ' . $username;
        header( "refresh:1;url=index.php" );
    
    } while(0);
}
?>
<?php include __DIR__ . '/components/header.php' ?>
<form method="post" action="login.php" class="form">
    <?php if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
    Email: <input type="email" name="email" value=""><br>
    Token: <input type="text" name="token"><br>
    <input type="submit" value="Activate">
    </div>
</form>
<?php include __DIR__ . '/components/footer.php' ?>