<?php

require __DIR__ . '/utils/utils.php';

//Error checking vars
$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-fail';
$success = false;

//check for redirection from successful login
$submittedRegistrationForm = !empty($_GET);

//check if form is submitted
$submittedForm = !empty($_POST);

//fill registered email + display alert message
if (!empty($_GET)) {
    //get all fields while trimming them and converting any special chars to html entities
    $email = htmlspecialchars(trim($_GET['email']));
    $password = '';
    $alertType = 'alert-success';
    $alertMessages = ['Your registration was successful'];
}

if ($submittedForm) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    //check for empty email
    if (!$email) {
        array_push($alertMessages, 'Please enter your email');
        array_push($invalidInputs, 'email');
    }
    //check for email validity
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    //check for empty password
    if (!$password) {
        array_push($alertMessages, 'Please enter your password');
        array_push($invalidInputs, 'password');
    }

    // if no errors at all: generate user and call @authenticateUser
    if (!count($alertMessages)) {
        $user = array(
            'email' => $email,
            'password' => $password
        );

        //authenticate entered email and password in DB
        if (authenticateUser($user) == 'success') {
            array_push($alertMessages, 'You have successfully logged in!');
            $alertType = 'alert-success';
            $success = true;

            //intentional display of general error msg if authentication was not successful 
        } else {
            array_push($alertMessages, 'Email and password do not match');
            array_push($invalidInputs, 'email' && 'password');
        }
    }
}

?>

<?php include './includes/header.php'; ?>

<main class="container">
    <h1 class="block-center">Login form using PHP validation</h1>
    <div class="form-container">
        <div class="border-rounded shadow-simple">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php if ($submittedForm) : ?>
                    <div class="container-flex-center">
                        <div class='alert <?php echo $alertType; ?>'><?php echo implode('<br>', $alertMessages); ?>
                        </div>
                    </div>
                <?php elseif ($submittedRegistrationForm) : ?>
                    <div class="container-flex-center">
                        <div class='alert <?php echo $alertType; ?>'><?php echo implode('<br>', $alertMessages); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Email*</label>
                    <input class="form-input<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" <?php if ($success == true) {
                                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                                } ?>>
                </div>
                <div class="form-group">
                    <label>Password*</label>
                    <input class="form-input<?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" type="password" name="password" <?php if ($success == true) {
                                                                                                                                                            echo 'disabled';
                                                                                                                                                        } ?>>
                </div>
                <div class="container-flex-center margin-top">
                    <button type="submit" class="btn-type-1" <?php if ($success == true) {
                                                                    echo 'disabled';
                                                                } ?>>Login</button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php include './includes/footer.php'; ?>