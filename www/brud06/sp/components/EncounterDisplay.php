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
$result = $encounter->simulateEncounter($character, $monster);
$_SESSION['encounter_result'] = $result;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Browser game</title>
</head>
<div class="encounter-wrapper">
    <h1 class="center-text">Encounter Result</h1>

    <div class=row-encounter>
        <div class="character-card">
            <h2>Character</h2>
            <p>Name: <?php echo $character->getName(); ?></p>
            <p>HP left: <?php echo max(0, $character->getHitpoints()); ?></p>
        </div>

        <div class="character-card">
            <h2>Monster</h2>
            <p>Name: <?php echo $monster->getName(); ?></p>
            <p>HP left: <?php echo max(0, $monster->getHitpoints()); ?></p>
        </div>
    </div>


    <div class="result-section">
        <p>Result: <?php echo $encounter->encounterResultDisplay($result); ?></p>
        <form method="POST" action="../finish_quest.php">
            <button type="submit">Confirm</button>
        </form>
    </div>
</div>