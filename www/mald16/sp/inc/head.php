<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/general.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">mald16-sp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="edit-profile.php">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                        </li>
                    <?php endif ?>
                    <?php if (!isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="register.php">Registrace</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="width: 50%; margin-top:100px; margin-bottom: 100px">
        <div style="position: fixed; width: fit-content; height: fit-content; bottom: 0; left: 0; background-color:bisque; padding: 10px">
            <strong>DevInfo</strong>
            <div>Logged in: <i><?php echo isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] ? "true" : "false" ?></i></div>
            <div>E-mail: <i><?php echo isset($_SESSION["user-email"]) ? $_SESSION["user-email"] : "empty" ?></i></div>
            <div>SM: <i><?php echo isset($_SESSION["sm"]) && !empty($_SESSION["sm"]) ? $_SESSION["sm"] :  "empty" ?></i></div>
            <div>IM: <i><?php echo isset($_SESSION["im"]) && !empty($_SESSION["im"]) ? $_SESSION["im"] :  "empty" ?></i></div>
            <div>EM: <i><?php echo isset($_SESSION["em"]) && !empty($_SESSION["em"]) ? $_SESSION["em"] : "empty"  ?></i></div>
        </div>