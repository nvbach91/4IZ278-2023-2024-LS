<?php
require_once 'database.php';

class InventoryDB extends Database{


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
        $sql = "SELECT * FROM sp_inventory WHERE character_id = :character_id";
        return $this->runQuery($sql, ['character_id' => $character_id]);
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