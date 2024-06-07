<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ./index.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
?>