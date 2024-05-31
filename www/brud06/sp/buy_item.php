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

if (isset($_SESSION['item_name'])) {
    $itemName = $_SESSION['item_name'];
    $item = $itemsDB->findByName($itemName);

    if ($gold >= $item['price_to_buy']) {
        $inventoryDB->addItemToInventory($characterData['character_id'], $item['item_id']);
        $gold -= $item['price_to_buy'];
        $character->setGold($gold);
        $characterDB->updateCharacter($character);

        // Remove the bought item from the blacksmith items in the session
        $key = array_search($item, $_SESSION['blacksmith_items']);
        if ($key !== false) {
            unset($_SESSION['blacksmith_items'][$key]);
        }
        
        header('Location: components/CharacterDisplay.php');
        exit();
    }
    else {
        echo "Not enough gold!";
    }

}
