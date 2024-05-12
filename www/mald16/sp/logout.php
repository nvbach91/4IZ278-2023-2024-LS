<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php

session_destroy();
header('Location: ' . "login.php");
exit();
