<?php

class Tags
{
    
    public function __construct(
        public int $id,
        public string $tag,
        public string $color,
        public int $priority,
        public int $home_id,
    ) { }


} 