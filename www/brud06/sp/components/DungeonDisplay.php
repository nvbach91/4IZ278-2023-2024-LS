<?php
session_start();

require_once '../db/CharactersDB.php';
require_once '../db/InventoryDB.php';
require_once '../db/ItemsDB.php';
require_once '../classes/Character.php';

$characterDB = new CharactersDB();
$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);

$gold = $character['gold'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Browser game</title>

</head>
<body>
    <div class="wrapper">
        <aside>
            <nav>
                <img src='../<?php echo $character['image']; ?>' alt="Profile Image" id="profileImage">
                <div> <?php echo "Gold: $gold" ?> </div>
                <ul>
                    <li><a href="./CharacterDisplay.php">Character</a></li>
                    <li><a href="./QuestDisplay.php">Quests</a></li>
                    <li><a href="./BlacksmithDisplay.php">Blacksmith</a></li>
                    <li><a href="./DungeonDisplay.php">Dungeons</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class = "dungeons">
            <div class="dungeon-card">
                <img src="../path/to/dungeon1/image.jpg" alt="Dungeon 1 Image">
                <h2>Dungeon 1</h2>
                <p>Description of Dungeon 1</p>
            </div>
            <div class="dungeon-card">
                <img src="../path/to/dungeon2/image.jpg" alt="Dungeon 2 Image">
                <h2>Dungeon 2</h2>
                <p>Description of Dungeon 2</p>
            </div>
        </main>
</body>