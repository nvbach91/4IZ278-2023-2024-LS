<?php
require_once 'db/Users.php';
require_once 'db/Tokens.php';
require_once 'utils/helpers.php';

$message = null;
$usersDb = new UsersDB();
$tokensDb = new TokensDB();
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    do { 
        if(empty($email)){
            $message = 'Please fill in the email field';
            $error = true;
            break;
        }

        $user = $usersDb->getUser('', $email);

        if($user == null){
            $message = 'No user was found under this email';
            $error = true;
            break;
        }

        $token = bin2hex(random_bytes(32));

        $tokensDb->create([$email, $token, currentDate('+15 minutes')]);

        $resetLink = "http://localhost/4IZ278-2023-2024-LS/www/fanm02/sp/new-password.php?token=$token";
        $emailContent = "Click the following link to reset your password: $resetLink. The link is valid for 15 minutes.\n\nIf you did not request a password reset, please ignore this email.";

        mail($email, "Password Reset", $emailContent);

        $message = "An email with instructions to reset your password has been sent to your email address.";

    } while(0);
}
?>
<?php include __DIR__ . '/components/header.php' ?>


<form method="post" action="reset-password.php" class="form">
    <?php if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
</div>
</form>

<?php include __DIR__ . '/components/footer.php' ?>