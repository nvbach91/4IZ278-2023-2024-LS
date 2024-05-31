<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
    <meta name='description' content='' />
    <meta name='author' content='' />
    <title>Dorm foodshare</title>
    <link href="./styles/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-->
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js'></script>
</head>
<body>
    <!-- Navigation-->
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <div class='container'>
            <a class='navbar-brand' href='index.php'>Dorm foodshare</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
            <div class='collapse navbar-collapse' id='navbarResponsive'>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-item active'><a class='nav-link' href='index.php'>Home</a></li>
                    <?php if (!isset($_COOKIE['display_name'])) : ?>
                        <li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>
                        <li class='nav-item'><a class='nav-link' href='register.php'>Register</a></li>
                    <?php endif ?>
                    <?php if (isset($_COOKIE['display_name'])) : ?>
                        <!--<li class='nav-item'><a class='nav-link' href='cart.php'>Košík</a></li>-->
                        <li class='nav-item'><a class='nav-link' href='profile.php'>
                            <?php
                                if(isset($_COOKIE['photo_url'])) {
                                    echo "<img src='".$_COOKIE['photo_url']."' style='width: 30px; height: 30px; border-radius: 50%;'> ";
                                }
                                else {
                                    echo "<img src='https://www.w3schools.com/howto/img_avatar.png' style='width: 30px; height: 30px; border-radius: 50%;'> ";
                                }
                            ?>Profil (<?php echo $_COOKIE['display_name'] ?>)</a></li>
                        <li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>