<?php

class Company
{
    public function __construct(private $name, private $address, private $logoUrl, private $website)
    {
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getFullAddress()
    {
        return $this->address->getFullAddress();
    }
}
