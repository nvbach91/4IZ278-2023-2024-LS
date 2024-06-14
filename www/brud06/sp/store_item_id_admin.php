<?php
session_start();
$_SESSION['item_id'] = $_GET['item_id'];
header('Location: ./admin/edit_item.php');
exit;