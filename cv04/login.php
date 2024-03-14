<?php include './includes/head.php'; ?>
<?php require './utils.php'; ?>

<?php
$showRegistrationSuccessMessage = false;
$showLoginErrorMessage          = false;
$showLoginSuccessMessage        = false;
if (isset($_GET['email'])) {
    $email = htmlspecialchars($_GET['email']);
    $showRegistrationSuccessMessage = true;
    $registrationSuccessMessage = 'Woohoo! You have successfully signed up!';
} else {
    $email = '';
}
$filePath = "./users.db";
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));


    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $showLoginErrorMessage = true;
        $loginErrorMessage="Please use a valid email";
    }
    else {
        if (! authenticate($filePath, $email, $password)) {
            $showLoginErrorMessage = true;
            $loginErrorMessage="This account does not exist";
        }
        else {
            $showLoginSuccessMessage = true;
            $loginSuccessMessage="You have successfully logged in";
        }
    }
}
?>

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="headline">Login</div>
    <?php if ($showLoginSuccessMessage): ?>
        <div class="form-success">
            <p><?php echo $loginSuccessMessage;?></p>
        </div>
    <?php elseif ($showRegistrationSuccessMessage): ?>
        <div class="form-success">
            <p><?php echo $registrationSuccessMessage;?></p>
        </div>
    <?php elseif ($showLoginErrorMessage): ?>
        <div class="form-errors">
            <p><?php echo $loginErrorMessage;?></p>
        </div>
    <?php endif;?>
    
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" placeholder="e.g. example@gmail.com" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" name="password" value="">
    </div>
    </div>
    <button class="btn btn-primary" type="submit">
        <p>Submit</p>
    </button>
</form>

<?php include './includes/foot.php'; ?>
