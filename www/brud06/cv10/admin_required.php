<?php
session_start();

if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 3) {
    echo "You don't have the required privileges to access this page.";
    exit;
}
?>