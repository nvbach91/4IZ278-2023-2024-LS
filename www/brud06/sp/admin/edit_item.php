<?php
session_start();
require_once '../restrictions/admin_required.php';
require_once '../db/ItemsDB.php';
$itemsDB = new ItemsDB();

include '../includes/admin_head.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    $newValues = [
        'name' => $_POST['name'],
        'image' => $_POST['image'],
        'strength' => $_POST['strength'],
        'hitpoints' => $_POST['hitpoints'],
        'luck' => $_POST['luck'],
        'equipment_type' => $_POST['equipment_type'],
        'price_to_buy' => $_POST['price_to_buy'],
        'price_to_sell' => $_POST['price_to_sell']
    ];

    $itemsDB->updateItem($item_id, $newValues);
    $_SESSION['success_message'] = "Item updated successfully!";
    header('Location: edit_item_display.php');
}

$item = $itemsDB->getItem($_SESSION['item_id']);
?>

<form class="item form" method="post">
    <input type="hidden" name="item_id" value="<?php echo isset($item['item_id']) ? $item['item_id'] : ''; ?>">
    Name: <input type="text" name="name" value="<?php echo isset($item['name']) ? $item['name'] : ''; ?>">
    Image URL: <input type="text" name="image" value="<?php echo isset($item['image']) ? $item['image'] : ''; ?>">
    Strength: <input type="text" name="strength" value="<?php echo isset($item['strength']) ? $item['strength'] : ''; ?>">
    Hitpoints: <input type="text" name="hitpoints" value="<?php echo isset($item['hitpoints']) ? $item['hitpoints'] : ''; ?>">
    Luck: <input type="text" name="luck" value="<?php echo isset($item['luck']) ? $item['luck'] : ''; ?>">
    Equipment Type: <input type="text" name="equipment_type" value="<?php echo isset($item['equipment_type']) ? $item['equipment_type'] : ''; ?>">
    Price to Buy: <input type="text" name="price_to_buy" value="<?php echo isset($item['price_to_buy']) ? $item['price_to_buy'] : ''; ?>">
    Price to Sell: <input type="text" name="price_to_sell" value="<?php echo isset($item['price_to_sell']) ? $item['price_to_sell'] : ''; ?>">
    <input type="submit" value="Update">
</form>
<a href="edit_item_display.php" class="back-button" onclick="<?php unset($_SESSION['item_id']); ?>">Back</a>
<?php include '../includes/foot.php'; ?>