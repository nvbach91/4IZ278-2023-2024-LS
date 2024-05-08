<?php

class homeCustomers
{
    
    public function __construct(
        
        public int $customer_id,
        public DateTime	$date_followed, 
        public int $home_id,
    ) { }


} 