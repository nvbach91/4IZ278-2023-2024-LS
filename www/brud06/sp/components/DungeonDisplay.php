<?php
session_start();

require_once '../db/CharactersDB.php';
require_once '../db/DungeonsDB.php';
require_once '../classes/Character.php';
require_once '../classes/Dungeon.php';

$characterDB = new CharactersDB();
$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$dungeonsDB = new DungeonsDB();
$forrestDungeonData = $dungeonsDB->getDungeonById(1);
$forrestDungeon = new Dungeon($forrestDungeonData);





$gold = $character['gold'];
$level = $character['level'];
$level_requirement = $forrestDungeon->getMinLvl()

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
        <main class="dungeons">
            <div class="dungeon-card">
                <img src="../<?php echo $forrestDungeonData['image'] ?>" alt="ForrestDungeonImage">
                <h2><?php echo $forrestDungeon->getName() ?></h2>
                <p><?php echo $forrestDungeon->getDescription() ?></p>
                <?php if ($level >= $level_requirement) : ?>
                    <form action="./FloorDisplay.php" method="post">
                        <button class="enter-dungeon" type="submit">Enter</button>
                    </form>
                <?php else : ?>
                    <button class="enter-dungeon" disabled>Level 10 required to enter</button>
                <?php endif; ?>
            </div>
            <div class="dungeon-card">
                <img src="../img/bob.jpg" alt="TBD">
                <h2>Under construction</h2>
                <p>Please look forward to it</p>
            </div>
        </main>
</body>