<?php

require_once 'Database.php';

class AssociationDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM association", []);
        return $results;
    }
    public function createAssociation($reservation_id, $car_id)
    {
        $results = $this->runQuery("INSERT INTO association (reservation_id, car_id) values (:reservation_id, :car_id) ", [":reservation_id" => $reservation_id, ":car_id" => $car_id]);
        return $results;
    }

    public function deleteAssociation($reservation_id, $car_id){
        $results = $this->runQuery("DELETE FROM association WHERE reservation_id like :reservation_id and car_id like :car_id", [":reservation_id" => $reservation_id, ":car_id" => $car_id]);
        return $results;
    }

    public function findOverview($year, $month)
    {
        $results = $this->runQuery("SELECT date, time, model, email, hotels.name FROM association
        left join reservations on reservations.reservation_id = association.reservation_id
        left join users on users.user_id = reservations.booked_by
        left join hotels on hotels.hotel_id = users.hotel
        left join cars on cars.car_id = association.car_id
        WHERE month(date) like :month and year(date) like :year
        order by date asc, time asc", [":month" => $month, ":year" => $year]);
        return $results;
    }

}