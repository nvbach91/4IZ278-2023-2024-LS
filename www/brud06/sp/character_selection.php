<?php
session_start();
require_once 'db/CharactersDB.php';
include './includes/head.php';

$characterDB = new CharactersDB();
$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);
?>

<?php if ($character): ?>
    <div class='character'>
        <img src='<?php echo $character['image']; ?>' alt='Character Image'>
        <h2><a href='components/CharacterDisplay.php'><?php echo $character['name']; ?></a></h2>
    </div>
<?php else: ?>
    <p>No character found. Create one!</p>
    <button onclick="location.href='character_creation.php'">Create Character</button>
<?php endif; ?>


