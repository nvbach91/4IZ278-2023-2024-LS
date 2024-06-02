<?php

require_once __DIR__ . '/Database.php';

class AddressDB extends Database {
    protected $tableName = 'address';

    public function create($street, $city, $zip_code, $country, $user_id) {
        $sql = "INSERT INTO $this->tableName (street, city, zip_code, country, user_id) VALUES (:street, :city, :zip_code, :country, :user_id)";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'street' => $street,
            'city' => $city,
            'zip_code' => $zip_code,
            'country' => $country,
            'user_id' => $user_id
        ]);
    }

    public function update($address_id, $street, $city, $zip_code, $country) {
        $sql = "UPDATE $this->tableName SET street = :street, city = :city, zip_code = :zip_code, country = :country WHERE address_id = :address_id";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'street' => $street,
            'city' => $city,
            'zip_code' => $zip_code,
            'country' => $country,
            'address_id' => $address_id
        ]);
    }

    public function findByUserId($user_id) {
        $sql = "SELECT * FROM $this->tableName WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['user_id' => $user_id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

?>
