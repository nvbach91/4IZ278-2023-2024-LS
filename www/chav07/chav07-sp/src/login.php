<?php 
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/database/DbConnection.php';
require_once __DIR__ . '/config.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Login</title>
</head>
<body>

    <div class="d-flex flex-column full-height">
        <?php require './requires/navigation.php'; ?>

        <div class="container-sm pt-3 navbar-spacing">
            <form action="./authentication/login.php" method="post" class="was-validated">
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <h1>Log in</h1>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <label for="loginEmail" class="form-label">E-mail</label>
                        <input name="loginEmail" type="email" id="loginEmail" class="form-control" required aria-required="true" placeholder="user@example.com">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input name="loginPassword" type="password" id="loginPassword" class="form-control" required aria-required="true" placeholder="*******">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <button class="btn btn-primary" type="submit">Log in</button>
                    </div>
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'invalid') : ?>
                        <p class="form-text col-3 text-danger text-end">Invalid email or password!</p>
                        <div class="col-3"></div>
                    <?php else: ?>
                        <div class="col-6"></div>
                    <?php endif; ?>

                </div>
                </div>
            </form>
            <div class="row mb-3">
                <!-- <hr class="col-2 mx-auto"> -->
                <p class="col-6 mx-auto text-center">or using</p>
            </div>
            <div class="row mb-3">
                <div class="col-6 mx-auto d-flex justify-content-center">
                    <a href="./authentication/oauth.php" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <?php include __DIR__ . "/includes/footer.php";?>
    </div>
    <script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>