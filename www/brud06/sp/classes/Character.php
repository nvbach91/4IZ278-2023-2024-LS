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

    public function __construct()
{
    $args = func_get_args();
    $numArgs = func_num_args();

    if ($numArgs == 1 && is_array($args[0])) {
        $data = $args[0];
        $this->name = $data['name'];
        $this->image = $data['image'];
        $this->class = $data['class'];
        $this->gold = $data['gold'];
        $this->xp = $data['xp'];
        $this->level = $data['level'];
        $this->strength = $data['strength'];
        $this->dexterity = $data['dexterity'];
        $this->hitpoints = $data['hitpoints'];
        $this->luck = $data['luck'];
        $this->stamina = $data['stamina'];
        $this->user_id = $data['user_id'];
    } else if ($numArgs == 12) {
        list($this->name, $this->image, $this->class, $this->gold, $this->xp, $this->level, $this->strength, $this->dexterity, $this->hitpoints, $this->luck, $this->stamina, $this->user_id) = $args;
    }
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