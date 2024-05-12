<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./db/User.php"; ?>
<?php

$User = new User($_GET["uid"], $_GET["oid"]);

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (!isset($_GET["uid"]) || empty($_GET["uid"]) || !isset($_GET["oid"]) || empty($_GET["oid"]) || !$User->getUserInOrg()) {
    $_SESSION["em"] = 14;
    header('Location: ' . "./edit-org.php?oid=" . $_GET["oid"]);
    exit();
} else {
    try {
        $User->deleteUserFromOrg($_GET["uid"], $_GET["oid"]);
        $_SESSION["sm"] = 16;
    } catch (Exception $e) {
        echo $e->getMessage();
        $_SESSION["em"] = 15;
    }

    header('Location: ' . "./edit-org.php?oid=" . $_GET["oid"]);
    exit();
}
