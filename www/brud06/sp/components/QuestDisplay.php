<?php
//session_start();
require_once '../restrictions/user_required.php';
require_once '../db/CharactersDB.php';
require_once '../db/QuestsDB.php';


$characterDB = new CharactersDB();
$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);

$gold = $character['gold'];
$strength = $character['strength'];
$dexterity = $character['dexterity'];
$hitpoints = $character['hitpoints'];
$luck = $character['luck'];

$questsDB = new QuestsDB();
// Check if there are already quests in the session
if (isset($_SESSION['quests'])) {
    // Use the quests from the session
    $quests = $_SESSION['quests'];
} else {
    // Generate new quests and store them in the session
    $quests = $questsDB->getRandomQuests(3);
    $_SESSION['quests'] = $quests;
}
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
                    <li><a href="#">Dungeons</a></li>
                    <li><a href="#">Hall of Fame</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <div class="background">
                <div class="quests">
                    <?php foreach ($quests as $quest) : ?>
                        <div class="quest">
                            <h2><?php echo $quest['name']; ?></h2>
                            <p><?php echo $quest['description']; ?></p>
                            <p>Stamina Cost: <?php echo $quest['stamina_cost']; ?></p>
                            <p>XP: <?php echo $quest['xp']; ?></p>
                            <p>Gold: <?php echo $quest['gold']; ?></p>
                            <form action="../accept_quest.php" method="post">
                                <input type="hidden" name="quest_id" value="<?php echo $quest['quest_id']; ?>">
                                <button type="submit" class="accept-quest">Accept Quest</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>