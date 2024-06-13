<?php
session_start();


require_once 'restrictions/user_required.php';
require_once 'restrictions/not_having_character_required.php';
require_once 'classes/Character.php';
require_once 'db/CharactersDB.php';

//var_dump($_SESSION['user_id']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $userId = $_SESSION['user_id'];

    // Get the selected image
    $image = $_POST['image'];

    // Define the other character attributes
    $class = 'Warrior';
    $gold = 10;
    $xp = 0;
    $level = 1;
    $strength = 10;
    $hitpoints = 100;
    $luck = 10;
    $stamina = 100;
    $last_action_time = time();
    $progression = 1;
    
    // Create the character
    $character = new Character($name, $image, $class, $gold, $xp, $level, $strength, $hitpoints, $luck, $stamina, $last_action_time, $progression, $userId);
    $characterDB = new CharactersDB();
    $characterDB->createCharacter($character);
    

    // Store character id in session
    $characterData = $characterDB->findCharacterByUserId($_SESSION['user_id']);

    if ($characterData) {
        $_SESSION['character_id'] = $characterData['character_id'];
    }

    header("Location: components/CharacterDisplay.php");
    exit();
}
?>

<?php include 'includes/head.php'; ?>

<form method="post" action="character_creation.php">
    <label for="name">Character Name:</label>
    <input type="text" id="name" name="name" required>

    <label>Character Image:</label>
    <input type="radio" id="warrior1m" name="image" value="img/warrior1m.jpg">
    <label for="warrior1m"><img src="img/warrior1m.jpg" height="50"></label>

    <input type="radio" id="warrior1f" name="image" value="img/warrior1f.jpg">
    <label for="warrior1f"><img src="img/warrior1f.jpg" width="50"></label>

    <input type="radio" id="mage1f" name="image" value="img/mage1f.jpg">
    <label for="mage1f"><img src="img/mage1f.jpg" width="50"></label>

    <input type="radio" id="mage1m" name="image" value="img/mage1m.jpg">
    <label for="mage1m"><img src="img/mage1m.jpg" width="50"></label>

    <input type="submit" value="Create Character">
</form>

<?php include 'includes/foot.php'; ?>