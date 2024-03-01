<?php
class Address{
    public function __construct(
        public string $street,
        public int $houseNumber,
        public int $orientingNumber,
        public string $city
    )
    {
        
    }
    public function addressToString()
    {
        return $this->street . " " . $this->houseNumber . "/". $this->orientingNumber . ", " . $this->city;
    }
}
?>