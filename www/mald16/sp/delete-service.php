<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php

$Organization = new Organization($_GET["oid"]);


if (!isset($_GET["sid"]) || empty($_GET["sid"]) || !isset($_GET["oid"]) || empty($_GET["oid"]) || !$Organization->getService($_GET["sid"])) {
    $_SESSION["em"] = 3;
    header('Location: ' . "./index.php");
    exit();
} else {
    try {
        $Organization->deleteService($_GET["sid"]);
    } catch (Exception $e) {
        $_SESSION["em"] = 7;
    }

    header('Location: ' . "./edit-org.php?oid=" . $_GET["oid"]);
    exit();
}
