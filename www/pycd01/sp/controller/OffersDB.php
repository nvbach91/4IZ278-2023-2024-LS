<?php
include_once '../controller/db.php';
include '../model/Offers.php';

class OffersDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'sp_homeOffers';
    }
    public function readAllFiltered($homeType, $minPrice, $maxPrice, $minSize, $maxSize)
    {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName.' WHERE homeType = :homeType');
        $statement->bindValue(':homeType', $homeType);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
    public function create($offer) 
    {
        $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (offer_type, home_type, price, address, image_url, size, rooms, garage_spaces, time_offered, level, agency_id) 
        VALUES (:offer_type, :home_type, :price, :address, :image_url, :size, :rooms, :garage_spaces, :time_offered, :level, :agency_id)');
        $statement->bindValue(':offer_type', $offer->offerType);
        $statement->bindValue(':home_type', $offer->homeType);
        $statement->bindValue(':price', $offer->price);
        $statement->bindValue(':address', $offer->address);
        $statement->bindValue(':image_url', $offer->imageURL);
        $statement->bindValue(':size', $offer->size);
        $statement->bindValue(':rooms', $offer->rooms);
        $statement->bindValue(':garage_spaces', $offer->garage_spaces);
        $statement->bindValue(':time_offered', $offer->time_offered);
        $statement->bindValue(':level', $offer->level);
        $statement->bindValue(':agency_id', $offer->agency_id);
        $statement->execute();
    }

    public function update($offer, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET offerType = :offerType, homeType = :homeType, price = :price, address = :address, imageURL = :imageURL, size = :size, rooms = :rooms, garage_spaces = :garage_spaces, time_offered = :time_offered, level = :level, agency_id = :agency_id WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->bindValue(':offerType', $offer->offerType);
        $statement->bindValue(':homeType', $offer->homeType);
        $statement->bindValue(':price', $offer->price);
        $statement->bindValue(':address', $offer->address);
        $statement->bindValue(':imageURL', $offer->imageURL);
        $statement->bindValue(':size', $offer->size);
        $statement->bindValue(':rooms', $offer->rooms);
        $statement->bindValue(':garage_spaces', $offer->garage_spaces);
        $statement->bindValue(':time_offered', $offer->time_offered);
        $statement->bindValue(':level', $offer->level);
        $statement->bindValue(':agency_id', $offer->agency_id);
        $statement->execute();
    }
}
