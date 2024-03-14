<?php 
require './utils/functions.php';


   if(!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];

    $answer = authenticate('./users.db', $email, $password);

    if ($answer !== "You have been successfuly logged in.") {
        array_push($errors, $answer);
    }

    if (count($errors) == 0) {
        $successMessage = "You have been successfuly logged in.";

    }




   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
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
                <label>Email</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '';?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="password" value="" type="password">
            </div>
            <div class="button-area">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
            
        </form>
    </div>
</body>
</html>