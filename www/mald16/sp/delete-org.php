<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>
<?php

$AccessUser = new User($_SESSION["user-email"], $_GET["oid"]); // an user, who is trying to make this change
if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$Organization = new Organization($_GET["oid"]);
$existingOrganization = $Organization->getOrganization();

if (!isset($_GET["oid"]) || empty($_GET["oid"]) || !$existingOrganization) {
    $_SESSION["em"] = 24;
    header('Location: ' . "./index.php");
    exit();
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
} else {
    $Organization->deleteOrg($_GET["oid"]);
    header('Location: ' . "./index.php");
    exit();
}
