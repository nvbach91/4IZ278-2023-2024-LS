<?php
require_once './classes/Database.php';

class UsersDB extends Database {
    public function create($data) {
        // TODO double check - create only if email not already used
        $statement = $this->pdo->prepare(
            "INSERT INTO Users (role, first_name, middle_name, last_name, email, date_of_birth) VALUES (:role, :first_name, :middle_name, :last_name, :email, :date_of_birth);"
        );
        $statement->bindParam(':role', $data['role'], PDO::PARAM_STR);
        $statement->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $statement->bindParam(':middle_name', $data['middle_name'], PDO::PARAM_STR);
        $statement->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindParam(':date_of_birth', $data['date_of_birth'], PDO::PARAM_STR);
        
        $statement->execute();
        echo "User created with ID: " . $this->pdo->lastInsertId() . "<br>";
    }

    public function find($user_id) {
        echo "find -$user_id- [UsersDB] <br>";
        $statement = $this->pdo->prepare("SELECT * FROM Users WHERE user_id = :user_id;");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $value) {
            echo $value['user_id'] . " | " . $value['first_name'] . "<br>";
        }
    }

    public function update($data) {
        echo "update - user ID: " . $data['user_id'] . " [UsersDB] <br>";
        $statement = $this->pdo->prepare(
            "UPDATE Users SET 
            role = :role, 
            first_name = :first_name, 
            middle_name = :middle_name, 
            last_name = :last_name, 
            email = :email, 
            date_of_birth = :date_of_birth 
            WHERE user_id = :user_id;"
        );
        
        $statement->bindParam(':role', $data['role'], PDO::PARAM_STR);
        $statement->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $statement->bindParam(':middle_name', $data['middle_name'], PDO::PARAM_STR);
        $statement->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindParam(':date_of_birth', $data['date_of_birth'], PDO::PARAM_STR);
        $statement->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
    
        $statement->execute();
        echo "User updated: " . $data['user_id'] . "<br>";
    }

    public function delete($user_id) {
        // TODO delete first parenthood if there's any ?
        echo "delete - user ID: " . $user_id . " [UsersDB] <br>";
        $statement = $this->pdo->prepare("DELETE FROM Users WHERE user_id = :user_id;");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        $statement->execute();
        echo "User deleted: " . $user_id . "<br>";
    }
}
?>