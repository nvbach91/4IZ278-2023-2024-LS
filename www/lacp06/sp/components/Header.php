<?php

require_once '../utils/check-privileges.php';
require_once '../utils/absolute-path.php';

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Comic Central</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?php echo $absolutePath; ?>styles/styles.css" rel="stylesheet" />
  <link href="<?php echo $absolutePath; ?>styles/css.css" rel="stylesheet" />
</head>

<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="<?php echo $absolutePath; ?>routes/index.php">Comic Central</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>routes/index.php">Homepage</a></li>
          <?php if (isset($_COOKIE["name"])) : ?>
            <?php if ($privileges > 2) : ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>routes/users.php">Uživatelé</a></li>
            <?php endif; ?>
            <li class="nav-item" style="display: flex; align-items: center; padding: 8px;">
              <a href="<?php echo $absolutePath; ?>routes/profile.php" style="color: wheat;"><?php echo $_COOKIE["name"]; ?></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>utils/logout.php">Odhlásit</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>routes/wishlist.php">Wishlist</a></li>
          <?php endif; ?>
          <?php if (!isset($_COOKIE["name"])) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>routes/register.php">Registrace</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>routes/login.php">Přihlásit</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo $absolutePath; ?>routes/cart.php">Košík</a></li>
        </ul>
      </div>
    </div>
  </nav>