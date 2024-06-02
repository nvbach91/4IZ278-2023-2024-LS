<?php 

require_once __DIR__ . "/../config.php";

// startSessionIfNone();
session_start();

session_destroy();

header("Location: " . BASE_URL . "/");

?>