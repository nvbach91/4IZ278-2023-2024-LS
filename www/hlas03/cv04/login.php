<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

session_start();
if(isset($_GET['email'])) {
    $email = $_GET['email'];
    unset($_GET['email']); // Odebrání zprávy, aby se nezobrazila znovu
}

if (!empty($_POST)) {
    // mame data neboli formular byl odeslan pomoci metody POST
    $email = htmlspecialchars(trim($_POST["email"]));
    $password  = htmlspecialchars(trim($_POST["password"]));

    // echo $name;
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "$email is not valid!");
    }
    if (!checkUserExists('./users.db', $email)) {
        array_push($errors, 'This user is not registered');
    }
    if (!authenticate('./users.db', $email, $password)) {
        array_push($errors, "Invalid email or password");
    }
    if (count($errors) == 0) {
        $successMessage = 'Login successful';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css"> 

</head>
<body>
    <div class="form-container">
        <?php if (isset($successMessage)): ?>
            <h2><?php echo $successMessage; ?></h2>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
            <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
            </div>
            <div class="form-group">
                <label>Password*</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>