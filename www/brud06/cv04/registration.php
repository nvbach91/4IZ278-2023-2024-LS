<?php
//read file
require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

$fileName = './users.db';


//echo $_SERVER['PHP_SELF'];
if (!empty($_POST)) {
    ##mame data neboli formular byld odeslan pomoci metody POST
    //var_dump($_POST);
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    $errors = [];

    if (strlen($name) < 3) {
        //echo "$name must have 3 or more characters";
        array_push($errors, "$name: Name must have 3 or more characters");
    }
    //user@domain.realm
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //echo "$email not valid";
        array_push($errors, "$email is not valid email");
    }
    if (checkUserExists($fileName, $email)) {
        array_push($errors, "User with email $email already exists");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must have 8 or more characters");
    }
    if ($password != $confirmPassword) {
        array_push($errors, "Passwords do not match");
    }
    if (count($errors) == 0) {
        $user = ['name' => $name, 'email' => $email, 'password' => $password];
        $registerResult = registerNewUser($fileName, $user);
        if ($registerResult === true) {
            // Send an email to the user
            $emailMessage = "<h1>Thank you for your registration</h1>";
            sendEmail($email, 'Registration successful', $emailMessage);
            $successMessage = 'You have successfully registered';
            sleep(1);
            header("Location: login.php?email=$email&message=" . urlencode($successMessage));
            exit;
        } else {
            array_push($errors, "User with email $email already exists");
        }
    }
} else {
    ## nemame data
}
?>

<?php include './includes/head.php'; ?>
<main class="main">
    <h1>Lab04 homework</h1>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Registration</h1>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
            <?php if (isset($successMessage)) : ?>
                <div class="alert alert-success">
                    <h2><?php echo $successMessage; ?></h2>
                </div>
            <?php endif; ?>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p class="form error"><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <div class="form-group">
            <label>Confirm Password*</label>
            <input type="password" class="form-control" name="confirmPassword" value="<?php echo isset($confirmPassword) ? $confirmPassword : '' ?>">
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>
<?php include './includes/foot.php'; ?>