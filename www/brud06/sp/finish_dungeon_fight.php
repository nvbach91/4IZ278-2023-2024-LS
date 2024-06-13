<?php
session_start();
require_once 'db/FloorsDB.php';
require_once 'db/CharactersDB.php';
require_once 'classes/Character.php';
require_once 'classes/Floor.php';

// Get the quest from the database
$floorsDB = new FloorsDB();
    $challengedFloorId = $_SESSION['challenged_floor'];
    $floorData = $floorsDB->getFloorById($challengedFloorId);
    $floor = new Floor($floorData);

$characterDB = new CharactersDB();
$characterData = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$character = new Character($characterData);

// Retrieve character's XP and gold
$characterXp = $character->getXp();
$characterGold = $character->getGold();
$characterLevel = $character->getLevel();
$requiredXP = 150;
$progression = $character->getProgression();

// Retrieve quest's XP and gold
$floorXp = $floor->getXp();
$floorGold = $floor->getGold();

var_dump($characterXp, $characterGold, $characterLevel, $questXp, $questGold);

// Check the result of the encounter
if (isset($_SESSION['encounter_result']) && $_SESSION['encounter_result']) {
    // The character won the encounter, update their gold and XP
    $character->setXp($characterXp + $floorXp);
    $character->setGold($characterGold + $floorGold);
    if ($character->getXp() >= $requiredXP) {
        $character->setLevel($characterLevel + 1);
        $character->setXp($character->getXp() - $requiredXP);
    }
    $character->setProgression($progression + 1);
    $characterDB->updateCharacter($character);
    unset($_SESSION['fight_type']);
    header('Location: components/FloorDisplay.php');
}


// Redirect back to character page
unset($_SESSION['fight_type']);
header('Location: components/CharacterDisplay.php');
exit;
