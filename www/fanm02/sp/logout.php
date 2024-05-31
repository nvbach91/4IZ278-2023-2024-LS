<?php
setcookie('display_name', '', time() - 3600, "/");
header('Location: index.php');
exit;

?>

