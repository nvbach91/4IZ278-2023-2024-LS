<?php
session_start();

require_once 'db/CharactersDB.php';
require_once 'db/UsersDB.php';
require_once 'db/InventoryDB.php';

$characterDB = new CharactersDB();
$usersDB = new UsersDB();
$inventoryDB = new InventoryDB();

$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$inventoryDB->deleteCharacterInventory($character['character_id']);
$characterDB->deleteCharacter($character['character_id']);

header('Location: character_selection.php');


?>