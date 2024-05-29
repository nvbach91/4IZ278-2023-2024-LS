<?php
session_start();
require_once 'db/QuestsDB.php';
require_once 'db/CharactersDB.php';
require_once 'classes/Character.php';
require_once 'classes/Quest.php';

// Check if quest_id is provided
//if (!isset($_POST['quest_id'])) {
  //  die('No quest selected');
//}

// Get the quest from the database
$questsDB = new QuestsDB();
if (isset($_SESSION['accepted_quest_id'])) {
    $acceptedQuestId = $_SESSION['accepted_quest_id'];
    $questData = $questsDB->getQuestById($acceptedQuestId);
    $quest = new Quest($questData);
}

$characterDB = new CharactersDB();
//$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$characterData = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$character = new Character($characterData);

// Retrieve character's XP and gold
$characterXp = $character->getXp();
$characterGold = $character->getGold();
$characterLevel = $character->getLevel();
$requiredXP = 150;

// Retrieve quest's XP and gold
$questXp = $quest->getXp();
$questGold = $quest->getGold();

var_dump($characterXp, $characterGold, $characterLevel, $questXp, $questGold);

// Check the result of the encounter
if (isset($_SESSION['encounter_result']) && $_SESSION['encounter_result']) {
    // The character won the encounter, update their gold and XP
    $character->setXp($characterXp + $questXp);
    $character->setGold($characterGold + $questGold);
    if ($character->getXp() >= $requiredXP) {
        $character->setLevel($characterLevel + 1);
        $character->setXp($character->getXp() - $requiredXP);
    }
    $characterDB->updateCharacter($character);
    header('Location: components/CharacterDisplay.php');
}


// Redirect back to character page
header('Location: components/CharacterDisplay.php');
exit;