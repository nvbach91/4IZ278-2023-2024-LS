<?php
class Quest {
    private $id;
    private $xp;
    private $gold;
    private $description;
    private $stamina_cost;
    private $monster_id;

    public function __construct() {
        $args = func_get_args();
        $numArgs = func_num_args();
    
        if ($numArgs == 1 && is_array($args[0])) {
            $data = $args[0];
            $this->id = $data['quest_id'];
            $this->xp = $data['xp'];
            $this->gold = $data['gold'];
            $this->description = $data['description'];
            $this->stamina_cost = $data['stamina_cost'];
            $this->monster_id = $data['monster_id'];
        } else if ($numArgs == 6) {
            list($this->id, $this->xp, $this->gold, $this->description, $this->stamina_cost, $this->monster_id) = $args;
        }
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