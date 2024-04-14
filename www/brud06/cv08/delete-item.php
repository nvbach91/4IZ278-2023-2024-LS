<?php
require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

if (isset($_GET['good_id'])) {
    echo "You do not have permission to delete this item.";
}

//if (isset($_GET['good_id'])) {
    //$good_id = $_GET['good_id'];
    //$goodsDB->delete($good_id);
//}

header('Location: index.php');
exit;
?>