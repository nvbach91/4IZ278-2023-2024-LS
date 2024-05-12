<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./db/Song.php"; ?>
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$Song = new Song($_GET["sid"]);

if (!isset($_GET["sid"]) || empty($_GET["sid"]) || !$Song) {
    $_SESSION["em"] = 6;
    header('Location: ' . "./index.php");
    exit();
} else {
    $Song->deleteSong($_GET["sid"]);
    header('Location: ' . "./index.php");
    exit();
}
