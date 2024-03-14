<?php
require("./utils/userUtils.php");

$errors = [];
$successMess = "";

const FILE_PATH = "./users.db";
const TRIM_CHARS = ' \n\r\t\v\x00';

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name'], TRIM_CHARS));
    $email = htmlspecialchars(trim($_POST['email'], TRIM_CHARS));
    $password = htmlspecialchars(trim($_POST['password'], TRIM_CHARS));
    $passwordC = htmlspecialchars(trim($_POST['passwordC'], TRIM_CHARS));

    $errors = validateUser($name, $email, $password, $passwordC);

    $user = ["name" => $name, "email" => $email, "password" => $password];
    registerNewUser($user, FILE_PATH);

    if (count($errors) == 0) {
        $successMess = "Thank you for your registration!";
        mail(
            $email,
            'Registration successful',
            '<h1>Thank you for your registration</h1>',
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./styles/form.css">
</head>

<body>
    <main>
        <h1><?php echo $successMess ?></h1>
        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <?php if (isset($_POST)) : ?>
                <?php foreach ($errors as $e) : ?>
                    <div class="alert alert-danger"><?php echo $e ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">
                <label>Name:</label>
                <br>
                <input class="form-control" name="name" type="text" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <br>
                <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <br>
                <input class="form-control" name="password" type="password" value="<?php echo isset($password) ? $password : '' ?>">
            </div>
            <div class="form-group">
                <label>Confirm password:</label>
                <br>
                <input class="form-control" name="passwordC" type="password" value="<?php echo isset($passwordC) ? $passwordC : '' ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <button type="button"><a href="./">Back</a></button>
        </form>

    </main>
</body>

</html>
