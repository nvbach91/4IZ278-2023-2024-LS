<?php
session_start();
require_once 'db/FloorsDB.php';
require_once 'db/CharactersDB.php';
require_once 'classes/Character.php';


// Get the floor from the database
$floorsDB = new FloorsDB();
$floor = $floorsDB->getFloorById($_POST['floor_id']);

$characterDB = new CharactersDB();
$characterData = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$character = new Character($characterData);

$requiredStamina = 20;
$characterStamina = $character->getStamina();

// Check if the character has enough stamina to accept the quest
if ($characterStamina < $requiredStamina) {
    $_SESSION['error'] = 'Not enough stamina to fight in a dungeon';
    header('Location: ./components/CharacterDisplay.php');
    exit;
}
$character->setStamina($characterStamina - $requiredStamina);
$characterDB->updateCharacter($character);

// Check if the quest exists and has a monster_id
if ($floor === false || !isset($floor['monster_id'])) {
    die('Invalid floor or no monster associated with quest');
}
$_SESSION['challenged_floor'] = $_POST['floor_id'];
$_SESSION['monster_id'] = $floor['monster_id'];
$_SESSION['fight_type'] = 'dungeon'; // for a dungeon


// Redirect back to quests page
header('Location: components/EncounterDisplay.php');
exit;