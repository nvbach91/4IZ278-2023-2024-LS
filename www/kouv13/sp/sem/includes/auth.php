<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['admin'])) {
    header('Location: /~kouv13/sem/admin');
    exit();
}
if (!isset($_SESSION['iduser'])) {
    header('Location: /~kouv13/sem/login?kick=5');
    exit();
}
