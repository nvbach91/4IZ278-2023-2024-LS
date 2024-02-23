<?php

class Pokemon {
    public function __construct(
        public $name,
        public $image,
        public $type,
    ) {}
    public function getType() {
        return "$this->name is an $this->type pokemon";
    }
}

?>