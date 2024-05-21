<?php

require_once 'Database.php';

class ReservationsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM reservations", []);
        return $results;
    }

    public function findByDateAndCarOld($date, $car){
        $results = $this->runQuery("SELECT * from time_blocks
        left join (SELECT association.reservation_id, association.car_id, reservations.date, reservations.time, users.name, users.email, users.hotel FROM association
                LEFT JOIN (SELECT * FROM reservations WHERE date like '$date') as reservations on reservations.reservation_id = association.reservation_id
                LEFT JOIN users on reservations.booked_by = users.user_id
                WHERE car_id like '$car'
                ORDER BY car_id ASC, time ASC) as asd on asd.time = time_blocks.time_id", []);
        return $results;
    }

    public function findByDateAndCar($date, $car){
        $results = $this->runQuery("SELECT time_id, reservation_id, car_id, date, time, asd.name, email, hotel, hotels.name as 'hotel_name', address from time_blocks
        left join (SELECT association.reservation_id, association.car_id, reservations.date, reservations.time, users.name, users.email, users.hotel FROM association
                LEFT JOIN (SELECT * FROM reservations WHERE date like '$date') as reservations on reservations.reservation_id = association.reservation_id
                LEFT JOIN users on reservations.booked_by = users.user_id
                WHERE car_id like '$car'
                ORDER BY car_id ASC, time ASC) as asd on asd.time = time_blocks.time_id
                LEFT JOIN hotels on hotel = hotels.hotel_id", []);
        return $results;
    }

    public function isReservation($user_id, $date, $time){
        $results = $this->runQuery("SELECT * from reservations where booked_by like '$user_id' and date like '$date' and time like '$time'", []);
        if (count($results) > 0){
            return [true, $results[0]['reservation_id']];
        }
        return [false, ''];
    }

    public function createReservation($user_id, $date, $time)
    {
        $results = $this->runQuery("INSERT INTO reservations (booked_by, date, time) values ('$user_id', '$date', '$time') ", []);
        return $results;
    }
}