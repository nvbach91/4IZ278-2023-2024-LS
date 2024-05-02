<?php
setcookie('email', '', time() - 10);
header('Location: index.php');
exit();
?>