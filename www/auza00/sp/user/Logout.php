<?php
session_start();
setcookie("googleEmail", "null", time()+86400);
session_destroy();
header('Location: /../index.php');
?>