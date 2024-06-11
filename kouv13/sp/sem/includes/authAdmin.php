<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: /sem/u');
    exit();
}
if (!$_SESSION['admin']) {
    header('Location: /sem/login?kick=6');
    exit();
}
