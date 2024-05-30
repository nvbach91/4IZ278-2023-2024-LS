<?php

session_start();
require_once '../db/CharactersDB.php';
require_once '../db/ItemsDB.php';
require_once '../db/InventoryDB.php';

$characterDB = new CharactersDB();
$character = $characterDB->findCharacterByUserId($_SESSION['user_id']);
$itemsDB = new ItemsDB();
$randomItems = $itemsDB->getRandomItems(6);
$inventoryDB = new InventoryDB();
$inventory = $inventoryDB->getInventory($character['character_id']);

$gold = $character['gold'];
$strength = $character['strength'];
$dexterity = $character['dexterity'];
$hitpoints = $character['hitpoints'];
$luck = $character['luck'];
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
                                    <li>Dexterity: <?php echo $dexterity; ?> <button class='increaseStat'>+</button></li>
                                    <li class="smallText">Chance to Avoid</li>
                                </div>
                                <div class="attribute">
                                    <li>HitPoints: <?php echo $hitpoints; ?> <button class='increaseStat'>+</button></li>
                                    <li class="smallText">Hit Point</li>
                                </div>
                                <div class="attribute">
                                    <li>Luck: <?php echo $luck; ?> <button class='increaseStat'>+</button></li>
                                    <li class="smallText">Critical Hit</li>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <!-- Rest of your code... -->
                    <div class="equipment">
                        <div class="weapon">
                            <!-- Weapon goes here -->
                            <img src="../img/sword.png" alt="Character Image" id="weaponImage">
                        </div>
                        <div class="armor">
                            <!-- Armor goes here -->
                            <img src="../img/sword.png" alt="Character Image" id="weaponImage">
                        </div>
                        <div class="ring">
                            <!-- Ring goes here -->
                            <img src="../img/sword.png" alt="Character Image" id="weaponImage">
                        </div>
                        <div class="boots">
                            <!-- Ring goes here -->
                            <img src="../img/sword.png" alt="Character Image" id="weaponImage">
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
                                <img class="item-img" src="../<?php echo $item['image']; ?>" alt="Item Image">
                                 <!-- Display item stats here. -->
                                <div class="item-stats">
                    <!-- Replace 'stat1', 'stat2', etc. with the actual stat names. -->
                    <p>Strength: <?php echo $item['strength']; ?></p>
                    <p>Dexterity: <?php echo $item['dexterity']; ?></p>
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

                        <div class="blacksmith-grid">
                            <?php foreach ($randomItems as $item) : ?>
                                <div class="item-card" onclick="confirmPurchase('<?php echo addslashes($item['name']); ?>', '<?php echo $item['price_to_buy']; ?>')">
                                    <img class="item-img" src='../<?php echo $item['image']; ?>' alt="Item Image">
                                    <h3 class="item-name"><?php echo $item['name']; ?></h3>
                                    <p class="item-price"><?php echo $item['price_to_buy']; ?> gold</p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="new-goods-button-container">
                            <button class="new-goods-button">New Goods</button>
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
    <script src="../js/script.js"></script>
</body>

</html>