<?php

require_once 'Database.php';

class ReservationsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM reservations", []);
        return $results;
    }
    public function findByEmail($email)
    {
        $results = $this->runQuery("SELECT * FROM cv10_users WHERE email like :email", ['email' => $email]);
        return $results;
    }
    public function createUser($email, $password)
    {
        $results = $this->runQuery("INSERT INTO cv10_users (email, password, privilege) values ('$email', '$password', 0) ", []);
        return $results;
    }
    public function updateUser($email, $privilege)
    {
        $results = $this->runQuery("UPDATE cv10_users SET privilege = $privilege WHERE email like '$email'", []);
        return $results;
    }
    public function findByDate($date){
        $results = $this->runQuery("SELECT association.reservation_id, association.car_id, reservations.date, reservations.time, users.name, users.email, users.hotel FROM association
        LEFT JOIN (SELECT * FROM reservations WHERE date like '$date') as reservations on reservations.reservation_id = association.reservation_id
        LEFT JOIN users on reservations.booked_by = users.user_id
        ORDER BY car_id ASC, time ASC", []);
        return $results;
    }

    public function findByDateAndCarOld($date, $car){
        $results = $this->runQuery("SELECT association.reservation_id, association.car_id, reservations.date, reservations.time, users.name, users.email, users.hotel FROM association
        LEFT JOIN (SELECT * FROM reservations WHERE date like '$date') as reservations on reservations.reservation_id = association.reservation_id
        LEFT JOIN users on reservations.booked_by = users.user_id
        WHERE car_id like '$car'
        ORDER BY car_id ASC, time ASC", []);
        return $results;
    }

    public function findByDateAndCar($date, $car){
        $results = $this->runQuery("SELECT * from time_blocks
        left join (SELECT association.reservation_id, association.car_id, reservations.date, reservations.time, users.name, users.email, users.hotel FROM association
                LEFT JOIN (SELECT * FROM reservations WHERE date like '$date') as reservations on reservations.reservation_id = association.reservation_id
                LEFT JOIN users on reservations.booked_by = users.user_id
                WHERE car_id like '$car'
                ORDER BY car_id ASC, time ASC) as asd on asd.time = time_blocks.time_id", []);
        return $results;
    }
}