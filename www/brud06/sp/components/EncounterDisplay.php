<?php
session_start();
require_once '../classes/MonsterEncounter.php';
require_once '../db/CharactersDB.php';
require_once '../db/MonstersDB.php';

// Check if character_id and monster_id are in the session
if (!isset($_SESSION['character_id'], $_SESSION['monster_id'])) {
    die('No character or monster selected');
}

// Fetch character and monster from the database
$characterDB = new CharactersDB();
$monsterDB = new MonstersDB();
$characterData = $characterDB->findCharacterById($_SESSION['character_id']);
$monsterData = $monsterDB->getMonsterById($_SESSION['monster_id']);

// Convert arrays to Character and Monster objects
$character = new Character($characterData);
$monster = new Monster($monsterData);

// Create a new MonsterEncounter and simulate the encounter
$encounter = new MonsterEncounter();
$result = $encounter->simulateEncounter($character, $monster);

// Check if character and monster exist
if (!$character || !$monster) {
    die('Invalid character or monster');
}

// Create a new MonsterEncounter and simulate the encounter
$encounter = new MonsterEncounter();
$result = $encounter->simulateEncounter($character,$monster);

?>

<h1>Encounter Result</h1>
<p>Character: <?php echo $character->getName(); ?></p>
<p>Character HP left: <?php echo max(0, $character->getHitpoints()); ?></p>
<p>Monster: <?php echo $monster->getName(); ?></p>
<p>Monster HP left: <?php echo max(0, $monster->getHitpoints()); ?></p>
<p>Result: <?php echo $result; ?></p>