<?php

require '../Controller/registration.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="name">Enter name</label>
            <input type="text" class="form-control" name="name">
            <label for="email">Enter email</label>
            <input type="text" class="form-control" name="email">
            <label for="password">Enter password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="button">Register</button>
    </form>
    <a href="index.php">Home</a>
</body>
</html>