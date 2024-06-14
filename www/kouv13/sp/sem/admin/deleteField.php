<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/incl.php';

$idField = htmlspecialchars($_POST["idField"]);

if ($field->deleteField($idField)) {
    header("Location: index.php?delf=1");
    exit();
} else {
    header("Location: index.php?delf=2");
    exit();
}
