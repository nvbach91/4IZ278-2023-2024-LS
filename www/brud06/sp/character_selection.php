<?php
// $query = "SELECT * FROM characters WHERE user_id = ?";
// $stmt = $db->prepare($query);
// $stmt->bind_param("i", $userId);
// $stmt->execute();
// $result = $stmt->get_result();

// while ($row = $result->fetch_assoc()) {
//     // Code removed
// }
?>

<div class='character'>
    <img src='dummy_image.jpg' alt='Character Image'>
    <h2><a href='components/CharacterDisplay.php'>Dummy Character</a></h2>
</div>

<button onclick="location.href='character_creation.php'">Create Character</button>
