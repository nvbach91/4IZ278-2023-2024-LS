<?php

require "./utils/users.php";

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $confirmPassword = htmlspecialchars(trim($_POST["confirmPassword"]));

    $errors = [];

    $userExists = $checkIfUserExists($email);

    if ($userExists) {
        array_push($errors, "User with email '$email' already exists");
    } else {
        if (empty($name)) {
            array_push($errors, "Name is required");
        } elseif (strlen($name) < 3) {
            array_push($errors, "Name must have 3 or more characters");
        }

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

        if (empty($confirmPassword)) {
            array_push($errors, "Confirm password is required");
        } elseif ($password !== $confirmPassword) {
            array_push($errors, "Passwords do not match");
        }
    }

    if (count($errors) == 0) {
        try {
            $registerUser($name, $email, $password);
            $successMessage = "Thank you for your registration";
        } catch (Exception $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>

<main>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h1>Sign Up</h1>

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

        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
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
        <div class="form-group">
            <label>Confirm password*</label>
            <input type="password" class="form-control" name="confirmPassword" value="<?php echo isset($confirmPassword) ? $confirmPassword : '' ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>