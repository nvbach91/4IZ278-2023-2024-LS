<?php

session_start();
$loggedIn = false;
if (isset($_COOKIE['name'])) {
    $loggedIn = true;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['theme'])) {
    if (empty($_SESSION['theme']) || $_SESSION['theme'] == 'light') {
        $_SESSION['theme'] = 'dark';
    } else {
        $_SESSION['theme'] = 'light';
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
