<?php
class User
{
    private $username;
    private $id;
    private $password;
    private $privilege;
    private $isBanned;

    public function __construct($id, $username, $password, $privilege, $isBanned)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->privilege = $privilege;
        $this->isBanned = $isBanned;
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPrivilege()
    {
        return $this->privilege;
    }

    public function setPrivilege($privilege)
    {
        $this->privilege = $privilege;
    }

    public function getIsBanned()
    {
        return $this->isBanned;
    }

    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;
    }
}
