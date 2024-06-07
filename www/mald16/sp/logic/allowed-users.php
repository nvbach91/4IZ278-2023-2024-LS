<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php

function isLoggedIn() {
    return isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true;
}

function allowedUsers($req) {
    if (in_array("logged-in", $req) && (!isset($_SESSION["logged-in"]) || $_SESSION["logged-in"] == false)) {
        $_SESSION["im"] = 4;
        header('Location: login.php');
        exit;
    }
}
