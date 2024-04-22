<?php
include_once './utils/db.php';
class Users
{
    public function __construct(
        public int $user_id,
        public string $name, 
        public string $email,
        public string $password,
        public string $privilege,
    ) { }


} 

class UsersDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'cv10_users';
    }
    public function create($user) 
    {
    $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (name, email, password, privilege) VALUES (:name, :email, :password, :privilege)');
    $statement->bindValue(':name', $user['name']);
    $statement->bindValue(':email', $user['email']);
    $statement->bindValue(':password', $user['password']);
    $statement->bindValue(':privilege', $user['privilege']);
    $statement->execute();
    }

    public function update($user, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET name = :name, email = :email, password = :password, privilege = :privilege WHERE user_id = :user_id');
        $statement->bindValue(':user_id', $user['user_id']);
        $statement->bindValue(':name', $user['name']);
        $statement->bindValue(':email', $user['email']);
        $statement->bindValue(':password', $user['password']);
        $statement->bindValue(':privilege', $user['privilege']);
        $statement->execute();
    }

    public function read($id)
    {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName.' WHERE user_id = :user_id');
        $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function delete($id) 
    {
        $statement = self::$DB->prepare('DELETE FROM '.$this->tableName.' WHERE user_id = :user_id');
        $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
        $statement->execute();

    }
}