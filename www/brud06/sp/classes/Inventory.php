<?php
class Inventory {
    private $characterId;
    private $itemId;

    public function __construct($characterId, $itemId, $quantity) {
        $this->characterId = $characterId;
        $this->itemId = $itemId;
    }

public function getCharacterId() {
    return $this->characterId;
}

public function setCharacterId($characterId) {
    $this->characterId = $characterId;
}

public function getItemId() {
    return $this->itemId;
}

public function setItemId($itemId) {
    $this->itemId = $itemId;
}
}
?>