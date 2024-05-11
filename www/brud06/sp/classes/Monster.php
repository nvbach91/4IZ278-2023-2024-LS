<?php
class Monster
{
    private $id;
    private $name;
    private $level;
    private $strength;
    private $dexterity;
    private $hitpoints;
    private $luck;
    private $isDungeonMonster;

    public function __construct($id, $name, $level, $strength, $dexterity, $hitpoints, $luck, $isDungeonMonster)
    {
        $this->id=$id;
        $this->name = $name;
        $this->level = $level;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->hitpoints = $hitpoints;
        $this->luck = $luck;
        $this->isDungeonMonster = $isDungeonMonster;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getDexterity()
    {
        return $this->dexterity;
    }

    public function setDexterity($dexterity)
    {
        $this->dexterity = $dexterity;
    }

    public function getHitpoints()
    {
        return $this->hitpoints;
    }

    public function setHitpoints($hitpoints)
    {
        $this->hitpoints = $hitpoints;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getIsDungeonMonster()
    {
        return $this->isDungeonMonster;
    }

    public function setIsDungeonMonster($isDungeonMonster)
    {
        $this->isDungeonMonster = $isDungeonMonster;
    }
}
