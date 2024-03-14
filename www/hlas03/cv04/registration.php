<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password  = htmlspecialchars(trim($_POST["password"]));
    $confirm_password  = htmlspecialchars(trim($_POST["confirm_password"]));

    $errors = [];

    if (strlen($name) < 3){
        array_push($errors, "$name must have 3 or more characters!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "$email is not valid!");
    }

    if ($password != $confirm_password){
        array_push($errors, "Passwords doesnt match");
    }
    if (strlen($password) < 8){
        array_push($errors, "Password is to short");
    }
    if (count($errors) == 0) {
        $registration = registerNewUser('./users.db', $name, $email, $password); 
        if ($registration == "Registration successful") {
            header("Location: login.php?email=" . urlencode($email));
            exit();
        } elseif ($registration == "Email already registered") {
            array_push($errors, 'You are already registered');
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/main.css"> 
</head>
<body>
    <div class="form-container">
        <div class="message-container">
            <?php if (!empty($errors)): ?>
                <div class="error-container">
                    <?php foreach ($errors as $error): ?>
                        <p class="form-error"><?php echo $error; ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>">
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
            </div>
            <div class="form-group">
                <label>Password* (Please use at least 8 characters)</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label>Confirm password*</label>
                <input type="password" class="form-control" name="confirm_password">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>