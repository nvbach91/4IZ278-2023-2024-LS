<?php
session_start();
session_unset();
session_destroy();
if (isset($_COOKIE['name'])) {
    setcookie('name', '', time() - 42000, '/');
    }
// Debugging: Check if session data is empty
if (empty($_SESSION)) {
    echo "Session data is empty";
} else {
    echo "Remaining session data: ";
    print_r($_SESSION);
}

header('Location: index.php?message=You\'ve+been+successfully+logged+out');
exit;
?>