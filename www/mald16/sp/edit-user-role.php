<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./db/User.php"; ?>
<?php require_once "./db/Organizations.php"; ?>

<!-- TODO: doesn't work -->

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$User = new User($_GET["uid"], $_GET["oid"]);
$existingUser = $User->getUser();

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
} else {
    $success = $User->updateUserRole($_GET["target"]);

    if ($success) {
        header('Location: ' . "./edit-org.php?oid=" . $_GET["oid"]);
        exit();
    } else {
        $_SESSION["em"] = 11;
        header('Location: ' . "./edit-org.php?oid=" . $_GET["oid"]);
        exit();
    }
}


?>