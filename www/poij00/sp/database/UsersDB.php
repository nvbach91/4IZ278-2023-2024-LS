<?php require_once __DIR__ . '/Database.php'; ?>


<?php 
session_start();

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
        $sql = "SELECT * FROM users WHERE username = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["username" => $username]);
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if ($statement->rowCount() == 0) {
            return "User not found.";
        }

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION["userid"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            return true; 
        } else {
            return "Invalid password.";
        }
    }


}

try {
    $users = new UsersDB();
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
}

?>



