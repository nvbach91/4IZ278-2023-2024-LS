<?php

if (!isset($_COOKIE['name'])) {
  header("Location: /www/lacp06/cv11/login.php");
  exit();
}
