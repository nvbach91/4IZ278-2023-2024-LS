<?php
class Floor {
    private $floor;
    private $monster_id;
    private $dungeon_id;
    private $xp;
    private $gold;

    public function __construct($floor, $monster_id, $dungeon_id, $xp, $gold) {
        $this->floor = $floor;
        $this->monster_id = $monster_id;
        $this->dungeon_id = $dungeon_id;
        $this->xp = $xp;
        $this->gold = $gold;
    }

    public function getFloor() {
        return $this->floor;
    }

    public function setFloor($floor) {
        $this->floor = $floor;
    }

    public function getMonsterId() {
        return $this->monster_id;
    }

    public function setMonsterId($monster_id) {
        $this->monster_id = $monster_id;
    }

    public function getDungeonId() {
        return $this->dungeon_id;
    }

    public function setDungeonId($dungeon_id) {
        $this->dungeon_id = $dungeon_id;
    }

    public function getXp() {
        return $this->xp;
    }

    public function setXp($xp) {
        $this->xp = $xp;
    }

    public function getGold() {
        return $this->gold;
    }

    public function setGold($gold) {
        $this->gold = $gold;
    }
}
?>