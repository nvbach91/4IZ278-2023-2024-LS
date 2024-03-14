<?php 

require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

if (!empty($_POST)){ //pokud máme data
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if(checkLoginInfo('./users.txt', $email, $password)){
        header("Location: ./logged.php");
    }
    if(!checkLoginInfo('./users.txt', $email, $password)){
        echo 'Username or email is incorrect.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form class="form-login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <h1>Login page</h1>
    <p>You are succesfully registered. Now you have to login.</p>
    <div class="form-group">
        <label>E-mail</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>"> <!--podmínka pokud je nastavena proměnná $name, vypiíše $name, jinak prázdný string-->
    </div>                                                                                      
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
    </div>
    <button class="btn btn-primary" id='btn-login' type="submit">Login</button>
    </form>
</body>
</html>