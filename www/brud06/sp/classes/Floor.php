<?php
class Floor {
    private $floor_id;
    private $number;
    private $xp;
    private $gold;
    private $monster_id;
    private $dungeon_id;


    public function __construct() {
        $args = func_get_args();
        $numArgs = func_num_args();
    
        if ($numArgs == 1 && is_array($args[0])) {
            $data = $args[0];
            $this->floor_id = $data['floor_id'];
            $this->number = $data['number'];
            $this->xp = $data['xp'];
            $this->gold = $data['gold'];
            $this->monster_id = $data['monster_id'];
            $this->dungeon_id = $data['dungeon_id'];
        } else if ($numArgs == 6) {
            list($this->floor_id, $this->number, $this->xp, $this->gold, $this->monster_id, $this->dungeon_id) = $args;
        }
    }

    public function getFloor() {
        return $this->floor_id;
    }

    public function setFloor($floor) {
        $this->floor_id = $floor;
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