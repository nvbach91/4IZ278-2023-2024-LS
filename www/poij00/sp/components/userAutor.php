<?php
require '../database/UsersDB.php';

if (isset($_SESSION['user_id'])) {
    $loggedInUser = $users->findBy('user_id', $_SESSION['user_id']);
}

function isAdmin($loggedInUser) {
if ($loggedInUser[0]['role_id'] == 1 ) {
    return true;
} else {
    return false;
};
}


?>