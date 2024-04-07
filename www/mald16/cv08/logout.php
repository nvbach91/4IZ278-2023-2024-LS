<?php
setcookie("name", $name, time());
header('Location: ' . "index.php");
