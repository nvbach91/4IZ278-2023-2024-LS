<?php
session_start();


require_once 'classes/Character.php';
require_once 'db/CharactersDB.php';

var_dump($_SESSION['user_id']);

//character_pictures = []
//character_pictures.append('img/warrior.png')

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $userId = $_SESSION['user_id'];

    // Define the other character attributes
    $image = 'img/profile-placeholder.png'; // Replace with actual image
    $class = 'Warrior';
    $gold = 10;
    $xp = 0;
    $level = 1;
    $strength = 10;
    $dexterity = 10;
    $hitpoints = 100;
    $luck = 10;
    $stamina = 100;

    $character = new Character($name, $image, $class, $gold, $xp, $level, $strength, $dexterity, $hitpoints, $luck, $stamina, $userId);
    $characterDB = new CharactersDB();
    $characterDB->createCharacter($character);

    // Store character id in session
if ($character) {
    $_SESSION['character_id'] = $character['character_id'];
}

    header("Location: components/CharacterDisplay.php");
    exit();
}
?>

<form method="post" action="character_creation.php">
    <label for="name">Character Name:</label>
    <input type="text" id="name" name="name" required>
    <input type="submit" value="Create Character">
</form>