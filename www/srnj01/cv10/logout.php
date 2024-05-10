<?php

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['email'])) {
  unset($_SESSION['email']);
  unset($_SESSION['privilege']);
}

header('Location: login.php');
