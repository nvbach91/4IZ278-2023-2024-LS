<?php
class Users
{
    public function __construct(
        public int $user_id,
        public string $registration_date,
        public string $name, 
        public string $email,
        public string $phone,
        public string $address,
    ) { }
} 

class UsersDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'users';
    }
    public function create($user) 
    {
    $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (user_id, registration_date, name, email, phone, address) VALUES (:user_id, :registration_date, :name, :email, :phone, :address)');
    $statement->bindValue(':user_id', $user->user_id);
    $statement->bindValue(':registration_date', $user->registration_date);
    $statement->bindValue(':name', $user->name);
    $statement->bindValue(':email', $user->email);
    $statement->bindValue(':phone', $user->phone);
    $statement->bindValue(':address', $user->address);
    $statement->execute();
    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($user, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET user_id = :user_id, registration_date = :registration_date, name = :name, email = :email, phone = :phone, address = :address WHERE id = :id');
        $statement->bindValue(':user_id', $user->user_id);
        $statement->bindValue(':registration_date', $user->registration_date);
        $statement->bindValue(':name', $user->name);
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':phone', $user->phone);
        $statement->bindValue(':address', $user->address);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
}