<?php

require __DIR__ . '/utils/utils.php';

// Error checking vars
$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-fail';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    // get all fields while trimming them and converting any special chars to html entities
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $passwordConfirm = htmlspecialchars(trim($_POST['passwordConfirm']));

    // check for empty name
    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    //check for empty password
    if (!$password) {
        array_push($alertMessages, 'Please choose a password');
        array_push($invalidInputs, 'password');
    }
    // check for password minimal length
    elseif (strlen($password) < 10) {
        array_push($alertMessages, 'Please enter password with at least 10 characters');
        array_push($invalidInputs, 'password');
    }
    //check for password maximal length
    elseif (strlen($password) > 26) {
        array_push($alertMessages, 'Sorry, this password is invalid');
        array_push($invalidInputs, 'password');
    }

    //check for empty password confirmation
    if (!$passwordConfirm) {
        array_push($alertMessages, 'Please confirm your password');
        array_push($invalidInputs, 'passwordConfirm');
    }
    //check for password equal password confirmation field
    elseif ($passwordConfirm != $password) {
        array_push($alertMessages, 'Passwords do not match');
        array_push($invalidInputs, 'passwordConfirm');
    }

    // if no errors at all: generate newUser and call @registerNewUser
    if (!count($alertMessages)) {
        $newUser = array(
            'name' => $name,
            'email' => $email,
            'password' => $password
        );

        //check if the registration was successful & redirection to login page if it was
        if (registerNewUser($newUser) != null) {
            sendEmailConfirmation($newUser);
            header('Location: login.php?email=' . $email);
            exit();
        } else {
            array_push($alertMessages, 'This email address is already used');
            array_push($invalidInputs, 'email');
        }
    }
}

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
    <h1 class="block-center">Registration Form using PHP validation</h1>
    <div class="form-container">
        <div class="border-rounded shadow-simple">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php if ($submittedForm) : ?>
                    <div class="container-flex-center">
                        <div class='alert <?php echo $alertType; ?>'><?php echo implode('<br>', $alertMessages); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Name*</label>
                    <input class="form-input<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                    <small>Example: John Wick</small>
                </div>
                <div class="form-group">
                    <label>Email*</label>
                    <input class="form-input<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($email) ? $email : ''; ?>" type="email">
                    <small>Example: JohnWicked@mail.com</small>
                </div>
                <div class="form-group">
                    <label>Password* (At least 10 characters)</label>
                    <input class="form-input<?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" name="password" value="<?php echo isset($password) ? $password : ''; ?>" type="password">
                    <small>Example: Xz%25LillaG</small>
                </div>
                <div class="form-group">
                    <label>Password Confirmation*</label>
                    <input class="form-input<?php echo in_array('passwordConfirm', $invalidInputs) ? ' is-invalid' : '' ?>" name="passwordConfirm" value="<?php echo isset($avatarURL) ? $passwordConfirm : ''; ?>" type="password">
                    <small>Type the same password again</small>
                </div>
                <div class="container-flex-center margin-top">
                    <button type="submit" class="btn-type-1">Submit</button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>