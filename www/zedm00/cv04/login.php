<?php
        require __DIR__ . '/utils.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>CV04</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <form class="form-signup d-grid gap-2 mx-auto my-4" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>"
        style="max-width: 500px;">

        <h1 class="h3 mb-3 font-weight-normal text-center">Login</h1>




        <?php

        $email = isset($_GET['email']) ? $_GET['email'] : '';


    if ($email != '') {
        echo '<div class="alert alert-success">Registration successful!</div>';
    } 
     

if (!empty($_POST)) {
  
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);


    $errors =[];

    $passwordFromFile = getPasswordByEmail('users.db', $email);

    if ($email == '') {
        $errors[] = 'Email is required.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email: ' . $email;
    } else if ($password == '') {
        $errors[] = 'Password is required.';

    } else if ($passwordFromFile == null) {
        $errors[] = 'User with this email does not exist.';
    } else if ($passwordFromFile != $password) {
        $errors[] = 'Invalid password.';
    }



if (!empty($errors)) {
    echo '<div class="alert alert-danger mt-5 gap-3">';
    foreach ($errors as $error) {
        echo '<div>'. $error . '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="alert alert-success">Login successful!</div>';
 
}

}

?>


       
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email :'' ?>">
        </div>


        <div class="form-group">
            <label>Password*</label>
            <input type="password" class="form-control" name="password"  value="<?php echo isset($password) ? $password :'' ?>">
        </div>
    
        

        <button class="btn btn-primary mt-4" type="submit">Submit</button>
    </form>


</body>
</html>