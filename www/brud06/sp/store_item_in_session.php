<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['item_name'] = $_POST['item_name'];
    echo "Item name stored in session.";
    header('Location: buy_item.php');
}
?>