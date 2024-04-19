<?php

if (!isset($_SESSION)) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Shop Homepage</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="styles/main.css" rel="stylesheet" />
</head>

<body class="min-vh-100">

  <div class="d-none">
    <?php require_once('../hotreloader.php'); ?>
  </div>
  <?php include('components/nav.php'); ?>
  <!-- Page Content-->
  <div class="container">
    <div class="mt-4">
      <?php
      if (isset($_GET['login']) && $_GET['login'] == 'success') : ?>
        <div class="alert alert-success" role="alert">
          <div class="d-flex flex-row align-items-center">
            <span class="mr-auto">Login successful!</span>
            <a href="index.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#155724" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
              </svg>
            </a>
          </div>
        </div>
      <?php endif;
      if (isset($_GET['logout']) && $_GET['logout'] == 'success') : ?>
        <div class="alert alert-success" role="alert">
          <div class="d-flex flex-row align-items-center">
            <span class="mr-auto">Logout successful!</span>
            <a href="index.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#155724" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
              </svg>
            </a>
          </div>
        </div>
      <?php endif;
      if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
        <div class="alert alert-success" role="alert">
          <div class="d-flex flex-row align-items-center">
            <span class="mr-auto">The operation was successfuly done.</span>
            <a href="?">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#155724" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
              </svg>
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>