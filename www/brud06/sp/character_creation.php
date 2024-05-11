<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$name = $_POST['name'];
    //$image = $_POST['image'];

    //$query = "INSERT INTO characters (user_id, name, image) VALUES (?, ?, ?)";
    //$stmt = $db->prepare($query);
    //$stmt->bind_param("iss", $userId, $name, $image);
    //$stmt->execute();

    header("Location: components/CharacterDisplay.php");
    exit();
}
?>

<form method="post" action="character_creation.php">
    <label for="name">Character Name:</label>
    <input type="text" id="name" name="name" required>

    <input type="submit" value="Create Character">
</form>