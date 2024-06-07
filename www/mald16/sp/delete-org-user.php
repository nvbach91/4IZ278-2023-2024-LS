<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./db/User.php"; ?>
<?php

$User = new User($_GET["uid"], $_GET["oid"]);

$AccessUser = new User($_SESSION["user-email"], $_GET["oid"]); // an user, who is trying to make this change
if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

if (!isset($_GET["uid"]) || empty($_GET["uid"]) || !isset($_GET["oid"]) || empty($_GET["oid"]) || !$User->getUserInOrg()) {
    $_SESSION["em"] = 14;
    header('Location: ' . "./edit-org.php?oid=" . $_GET["oid"]);
    exit();
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
} else {
    try {
        $User->deleteUserFromOrg($_GET["uid"], $_GET["oid"]);
        $_SESSION["sm"] = 16;
    } catch (Exception $e) {
        echo $e->getMessage();
        $_SESSION["em"] = 15;
    }

    header('Location: ' . "./edit-org-users.php?oid=" . $_GET["oid"]);
    exit();
}
