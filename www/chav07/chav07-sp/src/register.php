<?php 


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/config.php";

require_once __DIR__ . '/database/DbConnection.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Register</title>
</head>
<body>
    <div class="d-flex flex-column full-height">

        <?php require './requires/navigation.php'; ?>

        <div class="container-sm pt-3 navbar-spacing">
            <form action="./authentication/register.php" id="regForm" method="post" class="">
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <h1>Register</h1>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <label for="registerEmail" class="form-label">E-mail</label>
                        <input name="registerEmail" type="email" id="registerEmail" class="form-control" required aria-required="true" placeholder="user@example.com" onchange="setWasValidated()">
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <label for="registerName" class="form-label">Full Name</label>
                        <input name="registerName" type="text" id="registerName" class="form-control" required aria-required="true" placeholder="John Doe" onchange="setWasValidated()">
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input name="registerPassword" type="password" id="registerPassword" class="form-control" required aria-required="true" placeholder="*******" oninput="validatePasswordInput(this)" onchange="setWasValidated()" >
                        <div class="invalid-feedback">
                            Password must contain a-z, A-Z, 0-9, one or more special characters #?!@$ %^&*- and must be at least 8 characters long.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <label for="registerPasswordAgain" class="form-label">Confirm Password</label>
                        <input name="registerPasswordAgain" type="password" id="registerPasswordAgain" class="form-control" required aria-required="true" placeholder="*******" oninput="validatePasswordAgainInput(this)" onchange="setWasValidated()" >
                        <div class="invalid-feedback">
                            Password doesn't match the first password.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <button id="registerSubmit" class="btn btn-primary" type="submit" onload="disableButton()">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <?php include __DIR__ . "/includes/footer.php";?>
    </div>
    <script src="<?php echo BASE_URL;?>/js/validateInput.js"></script>
    <script src="<?php echo BASE_URL;?>/../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>