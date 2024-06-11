<?php
require_once 'database.php';

class InventoryDB extends Database
{

    function addItemToInventory($character_id, $item_id)
    {
        $sql = "INSERT INTO sp_inventory (character_id, item_id, is_equipped) VALUES (:character_id, :item_id, false)";
        $this->runQuery($sql, ['character_id' => $character_id, 'item_id' => $item_id]);
    }

    function removeItemFromInventory($character_id, $item_id)
    {
        $sql = "DELETE FROM sp_inventory WHERE character_id = :character_id AND item_id = :item_id";
        $this->runQuery($sql, ['character_id' => $character_id, 'item_id' => $item_id]);
    }

    function getInventory($character_id)
    {
        $sql = "SELECT * FROM sp_inventory WHERE character_id = :character_id AND is_equipped = 0";
        return $this->runQuery($sql, ['character_id' => $character_id]);
    }
    function deleteCharacterInventory($characterId)
    {
        $sql = "DELETE FROM sp_inventory WHERE character_id = :character_id";
        return $this->runQuery($sql, ['character_id' => $characterId]);
    }
    //Do not touch, somehow works
    function equipItem($itemId)
    {
        // Get the item type
        $sql = "SELECT sp_items.equipment_type FROM sp_inventory JOIN sp_items ON sp_inventory.item_id = sp_items.item_id WHERE sp_inventory.item_id = :item_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['item_id' => $itemId]);
        $itemType = $stmt->fetchColumn();

        // First, unequip any item of the same type
        $sql = "UPDATE sp_inventory SET is_equipped = 0 WHERE item_id IN (SELECT item_id FROM sp_items WHERE equipment_type = :equipment_type) AND is_equipped = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['equipment_type' => $itemType]);

        // Then, equip the new item
        $sql = "UPDATE sp_inventory SET is_equipped = 1 WHERE item_id = :item_id";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute(['item_id' => $itemId]);

        return $result !== false;
    }

    function unequipItem($itemId)
    {
        $sql = "UPDATE sp_inventory SET equipped = FALSE WHERE item_id = :item_id";
        return $this->runQuery($sql, ['item_id' => $itemId]);
    }
    public function getEquippedItems($characterId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sp_inventory WHERE character_id = :character_id AND is_equipped = 1");
        $stmt->execute(['character_id' => $characterId]);
        return $stmt->fetchAll();
    }
    public function getEquippedItemsWithStats($characterId)
    {
        $stmt = $this->pdo->prepare("
    SELECT sp_inventory.*, sp_items.strength, sp_items.hitpoints, sp_items.luck 
    FROM sp_inventory 
    INNER JOIN sp_items ON sp_inventory.item_id = sp_items.item_id 
    WHERE sp_inventory.character_id = :character_id AND sp_inventory.is_equipped = 1
    ");
        $stmt->execute(['character_id' => $characterId]);
        $items = $stmt->fetchAll();

        $equippedItems = [];

        foreach ($items as $item) {
            $equippedItems[] = [
                'item' => $item,
                'stats' => [
                    'strength' => $item['strength'],
                    'hitpoints' => $item['hitpoints'],
                    'luck' => $item['luck']
                ]
            ];
        }

        return $equippedItems;
    }


    public function getEquippedItemsWithType($characterId)
    {
        $stmt = $this->pdo->prepare("SELECT sp_inventory.*, sp_items.equipment_type FROM sp_inventory INNER JOIN sp_items ON sp_inventory.item_id = sp_items.item_id WHERE sp_inventory.character_id = :character_id AND sp_inventory.is_equipped = 1");
        $stmt->execute(['character_id' => $characterId]);
        $items = $stmt->fetchAll();

        $equippedItems = [
            'Weapon' => null,
            'Armor' => null,
            'Legs' => null,
            'Trinket' => null
        ];

        foreach ($items as $item) {
            switch ($item['equipment_type']) {
                case 'Weapon':
                    $equippedItems['Weapon'] = $item;
                    break;
                case 'Armor':
                    $equippedItems['Armor'] = $item;
                    break;
                case 'Legs':
                    $equippedItems['Legs'] = $item;
                    break;
                case 'Trinket':
                    $equippedItems['Trinket'] = $item;
                    break;
            }
        }

        return $equippedItems;
    }

    function getInventoryCount($character_id)
    {
        $sql = "SELECT COUNT(*) FROM sp_inventory WHERE character_id = :character_id AND is_equipped = 0";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['character_id' => $character_id]);
        $count = $stmt->fetchColumn();

        return $count;
    }
    public function getItemsByCharacterId($characterId)
    {
        $sql = "SELECT * FROM sp_inventory WHERE character_id = :character_id";
        $params = ['character_id' => $characterId];
        return $this->runQuery($sql, $params);
    }



    function create($attribute)
    {
        //empty
    }
    function update($attribute, $data)
    {
        //empty
    }
    function delete($attribute)
    {
        //empty
    }
    function find($attribute)
    {
        //empty
    }
}
