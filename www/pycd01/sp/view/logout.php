<?php
session_start();
setcookie('email', '', time());
header('Location: ./main.php');
