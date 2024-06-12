<?php require_once __DIR__ . '/Database.php'; ?>



<?php 

class UsersDB extends Database {
    protected $tableName = 'users';

    public function create($data) {
        $sql = "INSERT INTO $this->tableName (username, email, password) VALUES (:username, :email, :password)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $data['username'], 
            'email' => $data['email'], 
            'password' => $data['password'],
        ]);
    }

    public function userExists($username, $email) {
        $sql = "SELECT user_id FROM users WHERE username = :username or email = :email;";
        $statement = $this->pdo->prepare($sql);
        $statement -> execute(array($username, $email));

        if ($statement->rowCount() > 0) {
            $exists = true;
        } else {
            $exists = false;
        }
        return $exists;
    }





    public function loginUser ($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["username" => $username]);
        $user = $statement->fetchAll()[0];
        

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
    
            header('Location: ../main/index.php');
            exit;
        } else {
            header('HTTP/1.1 401 Unauthorized');
            exit('Invalid login');
        }
    }

    


}


    $users = new UsersDB();


?>



