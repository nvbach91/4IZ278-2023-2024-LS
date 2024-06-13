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
    private $hitpoints;
    private $luck;
    private $stamina;
    private $last_action_time;
    private $progression;
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
            $this->hitpoints = $data['hitpoints'];
            $this->luck = $data['luck'];
            $this->stamina = $data['stamina'];
            $this->last_action_time = $data['last_action_time'];
            $this->progression = $data['progression'];
            $this->user_id = $data['user_id'];
        } else if ($numArgs == 13) {
            list(
                $this->name, $this->image, $this->class, $this->gold, $this->xp, $this->level,
                $this->strength, $this->hitpoints, $this->luck, $this->stamina, $this->last_action_time,
                $this->progression, $this->user_id
            ) = $args;
        }
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
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
    public function getLastActionTime()
    {
        return $this->last_action_time;
    }
    public function setLastActionTime($last_action_time)
    {
        $this->last_action_time = $last_action_time;
    }
    public function getProgression()
    {
        return $this->progression;
    }
    public function setProgression($progression)
    {
        $this->progression = $progression;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function recoverStamina()
    {
        $current_time = time();

        // Ensure last_action_time is numeric
        if (!is_numeric($this->last_action_time)) {
            $this->last_action_time = $current_time;
        }

        $time_passed = $current_time - $this->last_action_time;

        // Regenerate stamina based on the time passed
        $stamina_to_recover = floor($time_passed / 10);

        // Ensure stamina is numeric
        if (!is_numeric($this->stamina)) {
            $this->stamina = 0;
        }

        // Add the recovered stamina to the current stamina, up to the maximum
        $this->stamina = min($this->stamina + $stamina_to_recover, 100);

        // Update the last action time
        $this->last_action_time = $current_time;

        return $this->stamina;
    }
}
