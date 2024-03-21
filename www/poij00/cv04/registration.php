<?php 
require './utils/functions.php';
$random = readFileContent('./users.db');

if(!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirm-password']));


    $errors = [];
    if (strlen($name) < 3 || !preg_match('/^[a-zA-Zá-žÁ-Ž\s]+$/u', $name)) {
        array_push($errors,  "Your name must have 3 or more characters, fill in your full name!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors,  "Your email is not a valid email!");
    } 

    if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        array_push($errors, "Your password should contain at least 8 characters, one uppercase letter and one number!");
    }

    if ($confirmPassword !== $password) {
        array_push($errors, "Your passwords do not match!");
    }

    if (registerNewUser('./users.db', $email) == true) {
        array_push($errors, "The user with this email is already registered.");
    }


    if (count($errors) == 0) {
        $successMessage = 'Thank you for registration';
        mail(
            $email,
            'Registration successful',
            '<h1>Thank you for you registration!</h1>',
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=UTF-8' . "\r\n" .
            'From: poij00@vse.cz' . "\r\n" .
            'Reply-to: poij00@vse.cz' . "\r\n" .
            'X-Mailer: PHP/' . phpversion()
        );
        $usersData = "$name;$email;$password" . PHP_EOL;
        $file = fopen('users.db', 'a');
        fwrite($file, $usersData);
        fclose($file);

        header("Location: login.php");
        exit;


    
        // appendFileContent('.database/users.db', $user);

    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Form</title>
</head>

<body>
<div class="panel"></div>
<div class="container">
    <div class="notifications">
    <?php if (isset($successMessage)):?>
        <h2><?php echo $successMessage ?></h2>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '';?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '';?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control password" name="password" type="password" value="">
    </div>
    <div class="form-group">
        <label>Confirm password</label>
        <input class="form-control password" name="confirm-password" type="password" value="">
    </div>
    <div class="button-area">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    
</form>
</div>
</body>
</html>