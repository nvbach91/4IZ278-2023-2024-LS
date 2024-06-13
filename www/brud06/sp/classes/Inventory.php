<?php
class Inventory
{
    private $characterId;
    private $itemId;
    private $capacity = 8;

    public function __construct($characterId, $itemId)
    {
        $this->characterId = $characterId;
        $this->itemId = $itemId;
    }
    
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function getCharacterId()
    {
        return $this->characterId;
    }

    public function setCharacterId($characterId)
    {
        $this->characterId = $characterId;
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }
    public function getCapacity()
    {
        return $this->capacity;
    }
    public function isInventoryFull($inventory)
    {
        return count($inventory) >= $this->capacity;
    }
}
