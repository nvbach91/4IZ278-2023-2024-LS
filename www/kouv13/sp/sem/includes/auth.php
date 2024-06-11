<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['admin'])) {
    header('Location: /sem/admin');
    exit();
}
if (!isset($_SESSION['iduser'])) {
    header('Location: /sem/login?kick=5');
    exit();
}
