<?php

session_start();
require_once '../restrictions/user_required.php';
require_once '../db/CharactersDB.php';
require_once '../db/ItemsDB.php';
require_once '../db/InventoryDB.php';
require_once '../classes/Character.php';


$characterDB = new CharactersDB();
$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$itemsDB = new ItemsDB();
//$randomItems = $itemsDB->getRandomItems(6);
// Check if there are already blacksmith items in the session
if (isset($_SESSION['blacksmith_items'])) {
    // Use the blacksmith items from the session
    $blacksmithItems = $_SESSION['blacksmith_items'];
} else {
    // Generate new blacksmith items and store them in the session
    $blacksmithItems = $itemsDB->getRandomItems(6);
    $_SESSION['blacksmith_items'] = $blacksmithItems;
}
$inventoryDB = new InventoryDB();
$inventory = $inventoryDB->getInventory($character['character_id']);
$equippedItems = $inventoryDB->getEquippedItemsWithType($character['character_id']);

$gold = $character['gold'];
$strength = $character['strength'];
$stamina = $character['stamina'];
$hitpoints = $character['hitpoints'];
$luck = $character['luck'];

$characterInstance = new Character($character);
$characterInstance-> recoverStamina();
$characterDB->updateCharacter($characterInstance);
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
        <main>
            <div class="background">
                <div class=characterAndEquipment>
                    <div class="characterInfo">
                        <div id="profile">
                            <img src='../<?php echo $character['image']; ?>' alt="Character Image" id="characterImage">
                        </div>
                        <div class="name">
                            <h2><?php echo $character['name']; ?></h2>
                        </div>
                        <div class="level">
                            <h3>Level <?php echo $character['level']; ?></h3>
                            <div class="xpBubble">
                                <p>Current XP: <?php echo $character['xp']; ?></p>
                                <p>XP needed to Level Up: 150 </p>
                            </div>
                        </div>
                        <div class="stats">
                            <ul>
                                <div class="attribute">
                                    <li>Strength: <?php echo $strength; ?> <button class='increaseStat'>+</button></li>
                                    <li class="smallText">Damage</li>
                                </div>
                
                                <div class="attribute">
                                    <li>HitPoints: <?php echo $hitpoints; ?> <button class='increaseStat'>+</button></li>
                                    <li class="smallText">Hit Point</li>
                                </div>
                                <div class="attribute">
                                    <li>Luck: <?php echo $luck; ?> <button class='increaseStat'>+</button></li>
                                    <li class="smallText">Critical Hit</li>
                                </div>
                                <div class="attribute">
                                    <li>Stamina: <?php echo $stamina; ?></li>
                                    <li class="smallText">Energy left</li>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="equipment">
                        <div class="item-card">
                            <!-- Weapon goes here -->
                            <?php if ($equippedItems['Weapon'] !== null) : ?>
                                <?php $weapon = $itemsDB->getItemDetails($equippedItems['Weapon']['item_id']); ?>
                                <img class='item-img' src="../<?php echo $weapon['image']; ?>" alt="Weapon Image" id="weaponImage">
                                <h3 class="item-name"><?php echo $weapon['name']; ?></h3>
                                <div class="item-stats">
                                    <p>Strength: <?php echo $weapon['strength']; ?></p>
                                    <p>Hitpoins: <?php echo $weapon['hitpoints']; ?></p>
                                    <p>Luck: <?php echo $weapon['luck']; ?></p>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="item-card">
                            <!-- Armor goes here -->
                            <?php if ($equippedItems['Armor'] !== null) : ?>
                                <?php $armor = $itemsDB->getItemDetails($equippedItems['Armor']['item_id']); ?>
                                <img class="item-img" src="../<?php echo $armor['image']; ?>" alt="Armor Image" id="armorImage">
                                <h3 class="item-name"><?php echo $armor['name']; ?></h3>
                                <div class="item-stats">
                                    <p>Strength: <?php echo $armor['strength']; ?></p>
                                    <p>Hitpoins: <?php echo $armor['hitpoints']; ?></p>
                                    <p>Luck: <?php echo $armor['luck']; ?></p>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="item-card">
                            <!-- Ring goes here -->
                            <?php if ($equippedItems['Trinket'] !== null) : ?>
                                <?php $trinket = $itemsDB->getItemDetails($equippedItems['Trinket']['item_id']); ?>
                                <img class = "item-img" src="../<?php echo $trinket['image']; ?>" alt="Ring Image" id="ringImage">
                                <h3 class="item-name"><?php echo $trinket['name']; ?></h3>
                                <div class="item-stats">
                                    <p>Strength: <?php echo $trinket['strength']; ?></p>
                                    <p>Hitpoins: <?php echo $trinket['hitpoints']; ?></p>
                                    <p>Luck: <?php echo $trinket['luck']; ?></p>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="item-card">
                            <!-- Boots go here -->
                            <?php if ($equippedItems['Legs'] !== null) : ?>
                                <?php $boots = $itemsDB->getItemDetails($equippedItems['Legs']['item_id']); ?>
                                <img class = "item-img" src="../<?php echo $boots['image']; ?>" alt="Boots Image" id="bootsImage">
                                <h3 class="item-name"><?php echo $boots['name']; ?></h3>
                                <div class="item-stats">
                                    <p>Strength: <?php echo $boots['strength']; ?></p>
                                    <p>Hitpoins: <?php echo $boots['hitpoints']; ?></p>
                                    <p>Luck: <?php echo $boots['luck']; ?></p>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="inventory-blacksmith-container">
                    <div class="inventory">
                        <!-- Inventory goes here -->
                        <?php for ($i = 0; $i < 6; $i++) : ?>
                            <div class="item-card">
                                <?php if (isset($inventory[$i])) : ?>
                                    <?php
                                    $item = $itemsDB->getItem($inventory[$i]['item_id']);
                                    ?>
                                    <!-- Display item image here. -->
                                    <img class="item-img" src="../<?php echo $item['image']; ?>" alt="Item Image" onclick="confirmInventoryAction('<?php echo addslashes($item['name']); ?>')">
                                    <h3 class="item-name"><?php echo $item['name']; ?></h3>
                                    <!-- Display item stats here. -->
                                    <div class="item-stats">
                                        <p>Strength: <?php echo $item['strength']; ?></p>
                                        <p>Hitpoins: <?php echo $item['hitpoints']; ?></p>
                                        <p>Luck: <?php echo $item['luck']; ?></p>
                                    </div>
                                <?php else : ?>
                                    <!-- Display empty slot. -->
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="blacksmith">
                        <h2>Blacksmith</h2>
                        <form action="../new_goods.php" method="post">
                            <button class="new-goods-button" type="submit">New Goods</button>
                        </form>
                        <div class="blacksmith-grid">
                            <?php foreach ($blacksmithItems as $item) : ?>
                                <div class="item-card" onclick="confirmPurchase('<?php echo addslashes($item['name']); ?>', '<?php echo $item['price_to_buy']; ?>')">
                                    <img class="item-img" src='../<?php echo $item['image']; ?>' alt="Item Image">
                                    <h3 class="item-name"><?php echo $item['name']; ?></h3>
                                    <p class="item-price"><?php echo $item['price_to_buy']; ?> gold</p>
                                    <div class="item-stats">
                                        <p>Strength: <?php echo $item['strength']; ?></p>
                                        <p>Hitpoins: <?php echo $item['hitpoints']; ?></p>
                                        <p>Luck: <?php echo $item['luck']; ?></p>
                                    </div>
                                </div>
                                
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
        </main>

    </div>
    <div id="confirmDialog" class="confirm-dialog-hidden">
        <div class="confirm-dialog-content">
            <p id="confirmDialogText"></p>
            <button id="confirmDialogYes">Yes</button>
            <button id="confirmDialogNo">No</button>
        </div>
    </div>
    <div id="inventoryActionDialog" class="confirm-dialog-hidden">
    <div class="confirm-dialog-content">
        <p id="inventoryActionDialogText"></p>
        <button id="inventoryActionDialogEquip">Equip</button>
        <button id="inventoryActionDialogSell">Sell</button>
        <button id="inventoryActionDialogCancel">Cancel</button>
    </div>

</div>
    <script src="../js/script.js"></script>
</body>

</html>