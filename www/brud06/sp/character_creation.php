<?php
session_start();


require_once 'classes/Character.php';
require_once 'db/CharactersDB.php';

var_dump($_SESSION['user_id']);

//character_pictures = []
//character_pictures.append('img/warrior.png')

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $userId = $_SESSION['user_id'];

    // Get the selected image
    $image = $_POST['image'];

    // Define the other character attributes
    //$image = 'img/profile-placeholder.png'; // Replace with actual image
    $class = 'Warrior';
    $gold = 10;
    $xp = 0;
    $level = 1;
    $strength = 10;
    $hitpoints = 100;
    $luck = 10;
    $stamina = 100;
    $last_action_time = date('Y-m-d H:i:s');
    

    $character = new Character($name, $image, $class, $gold, $xp, $level, $strength, $hitpoints, $luck, $stamina, $last_action_time, $userId);
    $characterDB = new CharactersDB();
    var_dump($character); // Add this line
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
    <input type="radio" id="warrior1m" name="image" value="img/warior1m.jpg" required>
    <label for="image1"><img src="img/warrior1m.jpg" height="50"></label>

    <input type="radio" id="warrior1f" name="image" value="img/warrior1f.jpg">
    <label for="image2"><img src="img/warrior1f.jpg" width="50"></label>

    <input type="radio" id="mage1f" name="image" value="img/mage1f.jpg">
    <label for="image3"><img src="img/mage1f.jpg" width="50"></label>

    <input type="radio" id="mage1m" name="image" value="img/mage1m.jpg">
    <label for="image4"><img src="img/mage1m.jpg" width="50"></label>

    <input type="submit" value="Create Character">
</form>

<?php include 'includes/foot.php'; ?>