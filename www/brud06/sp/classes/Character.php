<?php
class Character
{
    private $name;
    private $image;
    private $class;
    private $gold;
    private $xp;
    private $level;
    private $strength;
    private $dexterity;
    private $hitpoints;
    private $luck;
    private $stamina;
    private $user_id;

    public function __construct($name, $image, $class, $gold, $xp, $level, $strength, $dexterity, $hitpoints, $luck, $stamina, $user_id)
    {
        $this->name = $name;
        $this->image = $image;
        $this->class = $class;
        $this->gold = $gold;
        $this->xp = $xp;
        $this->level = $level;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->hitpoints = $hitpoints;
        $this->luck = $luck;
        $this->stamina = $stamina;
        $this->user_id = $user_id;
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

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function getGold()
    {
        return $this->gold;
    }

    public function setGold($gold)
    {
        $this->gold = $gold;
    }

    public function getXp()
    {
        return $this->xp;
    }

    public function setXp($xp)
    {
        $this->xp = $xp;
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

    public function getStamina()
    {
        return $this->stamina;
    }

    public function setStamina($stamina)
    {
        $this->stamina = $stamina;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
?>