<?php

namespace Vilem\BookBookGo\database;

class Author
{
    public int $id;
    public string $name;

    function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}