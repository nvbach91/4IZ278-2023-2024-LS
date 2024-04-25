<?php

require_once './db/database_eshop.php';
$userDB = new UsersDB();
if (isset($_COOKIE["name"])) {
  $user = $userDB->findUser($_COOKIE['name']);
  $privileges = $user['privileges'];
} else {
  $privileges = 0;
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Everyshop</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="styles.css" rel="stylesheet" />
</head>

<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Everyshop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
          <?php if ($privileges == 3) : ?>
            <li class="nav-item"><a class="nav-link" href="user-privileges.php">Users</a></li>
          <?php endif; ?>
          <?php if (isset($_COOKIE["name"])) : ?>
            <li class="nav-item" style="color:cornsilk; display: flex; align-items: center; padding: 8px;"><?php echo $_COOKIE["name"]; ?></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          <?php endif; ?>
          <?php if (!isset($_COOKIE["name"])) : ?>
            <li class="nav-item"><a class="nav-link" href="registration.php">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>