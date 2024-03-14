<?php

require "./utils/users.php";

if (!empty($_GET)) {
    $email = htmlspecialchars(trim($_GET["email"]));
}

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    $errors = [];

    if (empty($email)) {
        array_push($errors, "Email is required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "'$email' is not a valid email");
    }

    if (empty($password)) {
        array_push($errors, "Password is required");
    } elseif (strlen($password) < 8) {
        array_push($errors, "Password must have 8 or more characters");
    }

    if (count($errors) == 0) {
        try {
            $authenticate($email, $password);
            $successMessage = "Logged in!";
        } catch (Exception $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>

<main>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h1>Sign In</h1>

        <div>
            <?php if (isset($successMessage)) : ?>
                <h2 class="form-success"><?php echo $successMessage; ?></h2>
            <?php endif; ?>

            <?php if (!empty($errors)) : ?>
                <div class="form-errors">
                    <?php foreach ($errors as $error) : ?>
                        <p class="form-error"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>