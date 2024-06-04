<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php
require_once "./logic/allowed-users.php";
require_once "./logic/email.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./db/Song.php"; ?>
<?php require_once "./db/User.php"; ?>
<?php

$Song = new Song($_GET["sid"]);
$existingSong = $Song->getSong();

$AccessUser = new User($_SESSION["user-email"], $Song->orgId); // an user, who is trying to make this change
if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

if (!isset($_GET["sid"]) || empty($_GET["sid"]) || !$existingSong) {
    $_SESSION["em"] = 6;
    header('Location: ' . "./index.php");
    exit();
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
} else {
    sendMail($Song->getOwnerEmail(), "deleteSong");
    $Song->deleteSong($_GET["sid"]);
    header('Location: ' . "./index.php");
    exit();
}
