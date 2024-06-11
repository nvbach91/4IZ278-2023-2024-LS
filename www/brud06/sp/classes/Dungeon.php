<?php
class Dungeon
{
    private $dungeon_id;
    private $name;
    private $image;
    private $description;
    private $minlvl;

    public function __construct()
    {
        $args = func_get_args();
        $numArgs = func_num_args();

        if ($numArgs == 1 && is_array($args[0])) {
            $data = $args[0];
            $this->dungeon_id = $data['dungeon_id'];
            $this->name = $data['name'];
            $this->image = $data['image'];
            $this->description = $data['description'];
            $this->minlvl = $data['min_level'];
        } else if ($numArgs == 4) {
            list($this->dungeon_id, $this->name, $this->image, $this->description, $this->minlvl) = $args;
        }
    }


    public function getId()
    {
        return $this->dungeon_id;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getMinlvl()
    {
        return $this->minlvl;
    }

    public function setMinlvl($minlvl)
    {
        $this->minlvl = $minlvl;
    }
}
