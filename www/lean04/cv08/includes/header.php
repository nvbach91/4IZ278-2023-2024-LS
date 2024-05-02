<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/bootstrap.css" rel=" stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Mangoshop</a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php if (!isset($_COOKIE['name'])) : ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth/logout.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth/logout.php">Logout</a></li>
                    <?php endif; ?>
            </div>
        </div>
    </nav>