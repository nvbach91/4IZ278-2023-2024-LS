<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'users';

    // Check if username wasn´t used
    public function checkUsedUsername($username) {
        $sql = "SELECT user_id FROM $this->tableName WHERE username LIKE BINARY :username LIMIT 1";  //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $username
        ]);
        
        $existing_username = @$statement->fetchAll();
        return $existing_username;
    }

    // Check if email wasn´t used
    public function checkUsedEmail($email) {
        $sql = "SELECT user_id FROM $this->tableName WHERE email LIKE BINARY :email LIMIT 1";  //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        
        $existing_email = @$statement->fetchAll();
        return $existing_email;
    }

    // Create user from normal signup
    public function createUserNormal($args) {
        $sql = "INSERT INTO $this->tableName (username, email, password) VALUES (:username, :email, :password)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $args['username'],
            'email' => $args['email'],
            'password' => $args['password']
        ]);
    }

    // Create user from OAuth Register 
    public function createUserOAuth($args) {
        $sql = "INSERT INTO $this->tableName (username, email) VALUES (:username, :email)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $args['username'],
            'email' => $args['email']
        ]);
    }

    // Get user info by email
    public function getUserInfoByEmail($email) {
        $sql = "SELECT * FROM $this->tableName WHERE email LIKE BINARY :email LIMIT 1";  //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        
        $user = @$statement->fetchAll()[0];
        return $user;
    }

    // Get user info by username
    public function getUserInfoByUsername($username) {
        $sql = "SELECT * FROM $this->tableName WHERE username LIKE BINARY :username LIMIT 1";  //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $username
        ]);
        
        $user = @$statement->fetchAll()[0];
        return $user;
    }


    /*public function loginUserNormal($args) {
        $sql = "INSERT INTO $this->tableName (username, email, password) VALUES (:username, :email, :password)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $args['username'],
            'email' => $args['email'],
            'password' => $args['password'],
        ]);
    }
    public function createUserOAuth($args) {
        $sql = "INSERT INTO $this->tableName (name) VALUES (:name)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['name' => $args['name']]);
    }*/

}

?>