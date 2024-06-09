<?php
session_start();
require_once 'db/QuestsDB.php';
require_once 'db/CharactersDB.php';
require_once 'classes/Character.php';

// Check if quest_id is provided
if (!isset($_POST['quest_id'])) {
    die('No quest selected');
}

// Get the quest from the database
$questsDB = new QuestsDB();
$quest = $questsDB->getQuestById($_POST['quest_id']);

$characterDB = new CharactersDB();
$characterData = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$character = new Character($characterData);

$requiredStamina = $quest['stamina_cost'];
$characterStamina = $character->getStamina();

// Check if the character has enough stamina to accept the quest
if ($characterStamina < $requiredStamina) {
    $_SESSION['error'] = 'Not enough stamina to accept quest';
    header('Location: ./components/CharacterDisplay.php');
    exit;
}
$character->setStamina($characterStamina - $requiredStamina);
$characterDB->updateCharacter($character);

// Check if the quest exists and has a monster_id
if ($quest === false || !isset($quest['monster_id'])) {
    die('Invalid quest or no monster associated with quest');
}

// Store quest_id and monster_id in session
$_SESSION['accepted_quest_id'] = $_POST['quest_id'];
$_SESSION['monster_id'] = $quest['monster_id'];

// Clear the quests from the session
unset($_SESSION['quests']);

// Redirect back to quests page
header('Location: components/EncounterDisplay.php');
exit;