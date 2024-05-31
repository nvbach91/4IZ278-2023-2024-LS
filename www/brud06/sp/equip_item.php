<?php
session_start();

require_once 'db/InventoryDB.php';
require_once 'db/ItemsDB.php';

$inventoryDB = new InventoryDB();
$itemsDB = new ItemsDB();

if (isset($_SESSION['item_name'])) {
    $itemName = $_SESSION['item_name'];
    $item = $itemsDB->findByName($itemName);

    $inventoryDB->equipItem($item['item_id']);
}


?>