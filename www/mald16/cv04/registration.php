<?php include "./components/head.php";
require "./utils.php";


if (!empty($_POST)) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordConfirm = htmlspecialchars($_POST["password-confirm"]);

    $errors = [];
    $registerSuccess = false;

    if (strlen($name) < 5) {
        array_push($errors, "Name must be at least 5 characters long.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "E-mail address '$email' is not valid!");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Your password must be at least 8 characters long.");
    }
    if ($password != $passwordConfirm) {
        array_push($errors, "Passwords do not match.");
    }

    if (empty($errors)) {
        if (registerNewUser($name, $email, $password, true) == "taken") {
            array_push($errors, "E-mail is already in use.");
        } else {
            registerNewUser($name, $email, $password);
        }
    }
}

?>
<h1 style="text-align: center;">Register</h1>
<br>
<div style="display: flex; justify-content: center">
    <a href="./login.php" class="btn btn-outline-primary " style="margin-right: 10px;">Login</a><a href="./admin/users.php" class="btn btn-outline-primary">View all accounts</a>
</div>
<br>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" style="margin: 0 25%;">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <strong>Following errors occured:</strong>
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <div class="form-group mb-3">
        <label>Full name <span style="color: #ff0000;">*</span></label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>" required>
    </div>
    <div class="form-group mb-3">
        <label>Email <span style="color: #ff0000;">*</span></label>
        <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : "" ?>" required>
        <div class="form-text">
            E.g. xname@vse.cz
        </div>
    </div>
    <div class="form-group mb-3">
        <label>Password <span style="color: #ff0000;">*</span></label>
        <input class="form-control" name="password" type="password" value="" required>
        <div class="form-text">
            At least 8 characters.
        </div>
    </div>
    <div class="form-group">
        <label>Confirm password <span style="color: #ff0000;">*</span></label>
        <input class="form-control" name="password-confirm" type="password" value="" required>
    </div>
    <button class="btn btn-primary mt-3" type="submit">Register</button>
</form>
<?php include "./components/foot.php" ?>