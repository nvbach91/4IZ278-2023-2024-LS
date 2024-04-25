<?php
require 'user_required.php';
require 'manager_required.php';
require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

if (isset($_GET['good_id'])) {
    echo "You do not have permission to delete this item.";
}

//if (isset($_GET['good_id'])) {
    //$good_id = $_GET['good_id'];
    //$goodsDB->delete($good_id);
//}

header('Location: store.php');
exit;
?>