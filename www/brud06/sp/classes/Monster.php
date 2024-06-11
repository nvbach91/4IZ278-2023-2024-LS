<?php
class Monster
{
    private $id;
    private $name;
    private $image;
    private $level;
    private $strength;
    private $hitpoints;
    private $luck;
    private $isDungeonMonster;

    public function __construct()
    {
        $args = func_get_args();
        $numArgs = func_num_args();

        if ($numArgs == 1 && is_array($args[0])) {
            $data = $args[0];
            $this->id = $data['monster_id'];
            $this->name = $data['name'];
            $this->image = $data['image'];
            $this->level = $data['level'];
            $this->strength = $data['strength'];
            $this->hitpoints = $data['hitpoints'];
            $this->luck = $data['luck'];
            $this->isDungeonMonster = $data['isDungeonMonster'];
        } else if ($numArgs == 8) {
            list($this->id, $this->name, $this->level, $this->strength, $this->hitpoints, $this->luck, $this->isDungeonMonster) = $args;
        }
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
    public function getImage()
    {
        return $this->image;
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
