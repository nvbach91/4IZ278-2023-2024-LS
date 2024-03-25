<?php

abstract class Users
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email, 
        public int $age
        ) { }
}


