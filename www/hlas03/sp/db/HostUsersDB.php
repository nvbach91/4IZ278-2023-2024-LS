<?php

require_once __DIR__ . '/Database.php';

class HostUsersDB extends Database {
    protected $tableName = 'host_users';

    public function create($first_name, $last_name, $email, $phone) {
        $sql = "INSERT INTO $this->tableName (first_name, last_name, email, phone) VALUES (:first_name, :last_name, :email, :phone)";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone
        ]);
    }

    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
}

?>
