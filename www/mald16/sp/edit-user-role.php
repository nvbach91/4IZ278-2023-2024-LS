<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./db/User.php"; ?>
<?php require_once "./db/Organization.php"; ?>

<?php

$User = new User($_GET["uid"], $_GET["oid"]);
$existingUser = $User->getUser();
$AccessUser = new User($_SESSION["user-email"], $_GET["oid"]); // an user, who is trying to make this change
if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$Organization = new Organization($_GET["oid"]);
$existingOrg = $Organization->getOrganization();

if (
    !isset($_GET["uid"]) || empty($_GET["uid"]) ||
    !isset($_GET["oid"]) || empty($_GET["oid"]) ||
    !isset($_GET["target"]) || empty($_GET["target"]) ||
    !$existingUser && !$existingOrg ||
    $_GET["target"] != 1 &&  $_GET["target"] != 2
) {
    $_SESSION["em"] = 10;
    header('Location: ' . "./edit-org.php");
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
} else {
    $success = $User->updateUserRole($_GET["target"]);

    if ($success) {
        header('Location: ' . "./edit-org-users.php?oid=" . $_GET["oid"]);
        exit();
    } else {
        $_SESSION["em"] = 11;
        header('Location: ' . "./edit-org-users.php?oid=" . $_GET["oid"]);
        exit();
    }
}


?>