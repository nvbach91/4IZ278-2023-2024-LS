<?php
ob_start();
session_start();

require_once 'db/CharactersDB.php';
require_once 'db/InventoryDB.php';
require_once 'db/ItemsDB.php';
require_once 'classes/Character.php';


$characterDB = new CharactersDB();
$inventoryDB = new InventoryDB();
$itemsDB = new ItemsDB();

$characterData = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$character = new Character($characterData);
$gold = $character->getGold();

$inventoryCount = $inventoryDB->getInventoryCount($characterData['character_id']);

$isFull = $inventoryCount >= 6;

if (isset($_SESSION['item_name'])) {
    $itemName = $_SESSION['item_name'];
    $item = $itemsDB->findByName($itemName);

    $ownedItems = $inventoryDB->getItemsByCharacterId($characterData['character_id']);
    $isOwned = in_array($item['item_id'], array_column($ownedItems, 'item_id'));

    if ($gold < $item['price_to_buy']) {
        $_SESSION['blacksmith_message'] = "Not enough gold!";
    } elseif ($isFull) {
        $_SESSION['blacksmith_message'] = "Inventory is full!";
    }      elseif ($isOwned) {
            $_SESSION['blacksmith_message'] = "You already possess this item!";
    } else {
        $inventoryDB->addItemToInventory($characterData['character_id'], $item['item_id']);
        $gold -= $item['price_to_buy'];
        $character->setGold($gold);
        $characterDB->updateCharacter($character);

        // Remove the bought item from the blacksmith items in the session
        $key = array_search($item, $_SESSION['blacksmith_items']);
        if ($key !== false) {
            unset($_SESSION['blacksmith_items'][$key]);
        }

        header('Location: components/BlacksmithDisplay.php');
        exit();
    }
}