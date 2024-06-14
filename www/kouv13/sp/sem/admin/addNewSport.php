<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/incl.php';

$name = htmlspecialchars($_POST["name"]);
$s = $sport->getSport($name);

if (!empty($s)) {
    header("Location: index.php?adds=3");
    exit();
}

if ($sport->addSport($name)) {
    header("Location: index.php?adds=1");
    exit();
} else {
    header("Location: index.php?adds=2");
    exit();
}
