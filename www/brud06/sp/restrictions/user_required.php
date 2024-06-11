<?php

if (!isset($_SESSION['name'])) {
    header('Location: login.php?message=Please+log+in+first');
    exit;
}
?>