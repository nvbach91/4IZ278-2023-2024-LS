<?php
session_start();
require '../restrictions/admin_required.php';
require_once '../db/ItemsDB.php';
$itemsDB = new ItemsDB();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['back'])) {
        header('Location: admin_interface.php');
        exit;
    }
    $name = trim($_POST['name']);
    $image = trim($_POST['image']);
    $equipment_type = trim($_POST['equipment_type']);
    $valid_types = ['weapon', 'armor', 'trinket', 'legs'];

    $strength = $hitpoints = $luck = $price_to_buy = $price_to_sell = 0;

    if (!is_numeric($_POST['strength'])) {
        $errors[] = "Strength must be a number.";
    } else {
        $strength = intval($_POST['strength']);
    }

    if (!is_numeric($_POST['hitpoints'])) {
        $errors[] = "Hitpoints must be a number.";
    } else {
        $hitpoints = intval($_POST['hitpoints']);
    }

    if (!is_numeric($_POST['luck'])) {
        $errors[] = "Luck must be a number.";
    } else {
        $luck = intval($_POST['luck']);
    }

    if (!is_numeric($_POST['price_to_buy'])) {
        $errors[] = "Price to Buy must be a number.";
    } else {
        $price_to_buy = floatval(trim($_POST['price_to_buy']));
    }

    if (!is_numeric($_POST['price_to_sell'])) {
        $errors[] = "Price to Sell must be a number.";
    } else {
        $price_to_sell = floatval(trim($_POST['price_to_sell']));
    }

    if (!in_array($equipment_type, $valid_types)) {
        $errors[] = "Equipment Type must be one of the following: " . implode(", ", $valid_types) . ".";
    }

    // If no errors, proceed with creating the item
    if (empty($errors)) {
        $itemsDB->create([
            'name' => $name,
            'image' => $image,
            'strength' => $strength,
            'hitpoints' => $hitpoints,
            'luck' => $luck,
            'equipment_type' => $equipment_type,
            'price_to_buy' => $price_to_buy,
            'price_to_sell' => $price_to_sell
        ]);
        $_SESSION['success_message'] = "Item successfully created!";
        header('Location: admin_interface.php');
        exit;
    } else {
        foreach ($errors as $error) : ?>
            <?= $error ?><br>
<?php endforeach;
    }
}
?>

<?php include '../includes/admin_head.php'; ?>

<form class="item form" method="post">
    Name: <input type="text" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
    Image: <input type="text" name="image" value="<?= isset($_POST['image']) ? htmlspecialchars($_POST['image']) : '' ?>">
    Strength: <input type="text" name="strength" value="<?= isset($_POST['strength']) ? htmlspecialchars($_POST['strength']) : '' ?>">
    Hitpoints: <input type="text" name="hitpoints" value="<?= isset($_POST['hitpoints']) ? htmlspecialchars($_POST['hitpoints']) : '' ?>">
    Luck: <input type="text" name="luck" value="<?= isset($_POST['luck']) ? htmlspecialchars($_POST['luck']) : '' ?>">
    Equipment Type: <input type="text" name="equipment_type" value="<?= isset($_POST['equipment_type']) ? htmlspecialchars($_POST['equipment_type']) : '' ?>">
    Price to Buy: <input type="text" name="price_to_buy" value="<?= isset($_POST['price_to_buy']) ? htmlspecialchars($_POST['price_to_buy']) : '' ?>">
    Price to Sell: <input type="text" name="price_to_sell" value="<?= isset($_POST['price_to_sell']) ? htmlspecialchars($_POST['price_to_sell']) : '' ?>">
    <input type="submit" value="Create">
</form>
<form method="post">
    <input type="submit" name="back" value="Back">
</form>
<?php include '../includes/foot.php'; ?>