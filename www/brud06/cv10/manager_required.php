<?php

if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    echo "You don't have the required privileges to access this page.";
    exit;
}
?>