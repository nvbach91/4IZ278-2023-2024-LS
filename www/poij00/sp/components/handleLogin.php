
<?php 
session_start();

require '../database/UsersDB.php';

if (!empty($_POST)) {

    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

        $users->loginUser($username, $password);

}

?>