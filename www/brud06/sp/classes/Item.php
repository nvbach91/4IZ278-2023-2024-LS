<?php
class Item
{
    private $id;
    private $name;
    private $image;
    private $type;
    private $rarity;
    private $buyingCost;
    private $sellingCost;

    public function __construct($id, $name, $image, $type, $rarity, $buyingCost, $sellingCost)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->rarity = $rarity;
        $this->buyingCost = $buyingCost;
        $this->sellingCost = $sellingCost;
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getRarity()
    {
        return $this->rarity;
    }

    public function setRarity($rarity)
    {
        $this->rarity = $rarity;
    }

    public function getBuyingCost()
    {
        return $this->buyingCost;
    }

    public function setBuyingCost($buyingCost)
    {
        $this->buyingCost = $buyingCost;
    }

    public function getSellingCost()
    {
        return $this->sellingCost;
    }

    public function setSellingCost($sellingCost)
    {
        $this->sellingCost = $sellingCost;
    }
}
