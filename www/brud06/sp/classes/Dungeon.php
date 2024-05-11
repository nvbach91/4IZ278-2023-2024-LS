<?php
class Dungeon {
    private $id;
    private $name;
    private $description;
    private $minlvl;

    public function __construct($id, $name, $description, $minlvl) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->minlvl = $minlvl;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getMinlvl() {
        return $this->minlvl;
    }

    public function setMinlvl($minlvl) {
        $this->minlvl = $minlvl;
    }
}
?>