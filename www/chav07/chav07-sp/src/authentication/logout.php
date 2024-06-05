<?php 

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/AuthUtils.php";
//session_start();
startSessionIfNone();

session_destroy();

header("Location: " . BASE_URL . "/");

?>