<?php
ob_start();
session_start();

require_once 'db/InventoryDB.php';
require_once 'db/ItemsDB.php';
require_once 'db/CharactersDB.php';
require_once 'classes/Character.php';

$baseStrength = 10;
$baseHitpoints = 100;
$baseLuck = 10;

$itemsStrength = 0;
$itemsHitpoints = 0;
$itemsLuck = 0;

$inventoryDB = new InventoryDB();
$itemsDB = new ItemsDB();
$charactersDB = new CharactersDB();

$characterData = $charactersDB->findCharacterByUserId($_SESSION['user_id']);
$character = new Character($characterData);



if (isset($_SESSION['item_name'])) {
    $itemName = $_SESSION['item_name'];
    $item = $itemsDB->findByName($itemName);

    $inventoryDB->equipItem($item['item_id']);
    
    $equipped_items = $inventoryDB->getEquippedItemsWithStats($characterData['character_id']);

    foreach ($equipped_items as $item) {
        $itemsStrength += $item['stats']['strength'];
        $itemsHitpoints += $item['stats']['hitpoints'];
        $itemsLuck += $item['stats']['luck'];
    }
    $totalStrength = $baseStrength + $itemsStrength;
    $totalHitpoints = $baseHitpoints + $itemsHitpoints;
    $totalLuck = $baseLuck + $itemsLuck;

    $character->setStrength($totalStrength);
    $character->setHitpoints($totalHitpoints);
    $character->setLuck($totalLuck);

    $charactersDB->updateCharacter($character);

}


?>