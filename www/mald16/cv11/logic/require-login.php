<?php

session_start();

if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["logged-in"] != true) {
    header('Location: ' . "login.php");
}
