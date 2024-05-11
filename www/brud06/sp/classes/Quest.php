<?php
class Quest {
    private $id;
    private $xp;
    private $gold;
    private $description;
    private $stamina_cost;
    private $monster_id;

    public function __construct($id, $xp, $gold, $description, $stamina_cost, $monster_id) {
        $this->id = $id;
        $this->xp = $xp;
        $this->gold = $gold;
        $this->description = $description;
        $this->stamina_cost = $stamina_cost;
        $this->monster_id = $monster_id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getStaminaCost() {
        return $this->stamina_cost;
    }

    public function setStaminaCost($stamina_cost) {
        $this->stamina_cost = $stamina_cost;
    }

    public function getMonsterId() {
        return $this->monster_id;
    }

    public function setMonsterId($monster_id) {
        $this->monster_id = $monster_id;
    }
}
?>