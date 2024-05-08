<?php
enum offerType {
    case buy;
    case rent;
}
enum homeType {
    case apartment;
    case house;
}
class Offers
{
    
    public function __construct(
        public int $id,
        public offerType $offerType,
        public homeType $homeType,
        public int $price,
        public string $address,
        public string $imageURL,
        public int $size,
        public int $rooms,
        public int $garage_spaces,
        public DateTime $time_offered,
        public int $level,
        public int $agency_id,
    ) { }


} 