<?php

require '.' . DIRECTORY_SEPARATOR . 'utils.php';

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];

    if (!checkUserExist('./users.text', $email)) {
        array_push($errors, 'User with this email does not exist!');
    }
    if (!checkCorrectPasword('./users.text', $email, $password) || $password == null) {
        array_push($errors, 'Wrong password!');
    }

    if (count($errors) == 0) {
        header('Location: http://localhost/cv01/ukoly/ukol04/users.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form class="form-login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" value="">
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
    <p><a class="button" href="./home.php">Back</a></p>
</body>
</html>