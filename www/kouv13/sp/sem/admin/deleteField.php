<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/db/db.class.php';
$db = new db();

$idField = htmlspecialchars($_POST["idField"]);

if ($db->deleteField($idField)) {
    header("Location: index.php?delf=1");
    exit();
} else {
    header("Location: index.php?delf=2");
    exit();
}
