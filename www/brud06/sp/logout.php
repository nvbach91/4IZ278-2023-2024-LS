<?php
session_unset();
session_destroy();
if (isset($_COOKIE['name'])) {
    setcookie('name', '', time() - 42000, '/');
}

header('Location: index.php?message=You\'ve+been+successfully+logged+out');
exit;
?>