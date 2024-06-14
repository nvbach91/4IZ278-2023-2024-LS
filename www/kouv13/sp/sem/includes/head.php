<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once __DIR__ . '../../config.php';
    include BASE_PATH . '/includes/bth.php'; ?>
    <base href="/~kouv13/sem/">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/list-groups.css" rel="stylesheet">