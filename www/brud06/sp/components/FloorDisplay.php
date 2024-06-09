<?php
session_start();



require_once '../db/CharactersDB.php';
require_once '../db/FloorsDB.php';
require_once '../db/MonstersDB.php';
require_once '../classes/Floor.php';
require_once '../classes/Character.php';
require_once '../classes/Monster.php';


$floorsDB = new FloorsDB();
$monsterDB = new MonstersDB();
$charactersDB = new CharactersDB();
$current_floor = 2;
$character = $charactersDB->findCharacterByUserId($_SESSION['user_id']);
$gold = $character['gold'];


$floorToBeDisplayed = $floorsDB->getFloorById($current_floor);
$monster = $monsterDB->getMonsterById($floorToBeDisplayed['monster_id']);
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
        <main class="floor">
            <div class="floor-card">
                <img class="floor-image" src="../<?php echo $monster['image']?>" alt="Monster Image">
                <h3><?php echo $floorToBeDisplayed['description']?></h3>
                <form action="../challenge_dungeon.php" method="post">
                                <input type="hidden" name="floor_id" value="<?php echo $floorToBeDisplayed['floor_id']; ?>">
                                <button type="submit" class="challenge-button">Challenge Monster</button>
                            </form>
            </div>
        </main>

