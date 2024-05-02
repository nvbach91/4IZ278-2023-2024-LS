<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          'sans': ['IBM Plex Sans', 'sans-serif'],
        },
        extend: {
          colors: {
            'white': '#fff',
            'blue': '#546A76',
            'red': '#ED6A5E',
            'green': '#7B886F'
          }
        }
      }
    }
  </script>
</head>

<body>
  <div class="hidden">
    <?php require_once('../hotreloader.php'); ?>
  </div>
  <div class="w-full p-4 pl-8 pr-8 flex justify-between items-center bg-blue text-white">
    <h1 class="text-2xl">Simple login</h1>
    <div class="flex">
      <?php if (isset($_SESSION['email'])) : ?>
        <a href="logout.php" class="p-2">Logout</a>
        <?php if (isset($_SESSION['privilege']) && $_SESSION['privilege'] > 1) : ?>
          <a href="items.php" class="p-2">Items</a>
          <?php if ($_SESSION['privilege'] > 2) : ?>
            <a href="user-privileges.php" class="p-2">Users</a>
          <?php endif; ?>
        <?php endif; ?>
      <?php else : ?>
        <a href="login.php" class="p-2">Login</a>
        <a href="register.php" class="p-2">Register</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="p-8">