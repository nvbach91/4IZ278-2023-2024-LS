<?php 

require_once __DIR__ . "/IUserRepository.php";
require_once __DIR__ . "/dbconnection.php";


class UserRepository implements IUserRepository {

    public function getUserByEmail(string $email) : ?User{
        try{
            $pdo = DbConnection::getConnection();
            $statement = $pdo->prepare("SELECT * FROM USERS WHERE EMAIL LIKE :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $response = $statement->fetchAll();
            if(empty($response)){
                return null;
            }

            $resultUser = new User(
                $response[0]["USER_ID"],
                $response[0]["EMAIL"],
                $response[0]["NAME"],
                $response[0]["PASSWORD"],
                AuthRole::class::from($response[0]["ROLE"])
            );

            // var_dump($resultUser);
            return $resultUser;
            
        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }
        return null;

    }
    public function getUserById(int $id) : ?User{

        try{

        }
        catch(PDOException $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }


        return null;
    }
    public function createUser(UserCreateDTO $user){

        try{
            $pdo = DbConnection::getConnection();
            $existingUser = $this->getUserByEmail($user->email);
            if($existingUser != null){
                exit("User with the same e-mail has been already registered.");
            }

            $statement = $pdo->prepare("INSERT INTO USERS(EMAIL, PASSWORD, NAME, ROLE) VALUES(:email, :password, :name, :role)");

            $statement->bindValue(":email", $user->email);
            $statement->bindValue(":password", $user->password);
            $statement->bindValue(":name", $user->name);
            $statement->bindValue(":role", $user->role->value);
            $statement->execute();

        }
        catch(Exception $e){
            exit("Error trying to access the database: " . $e->getMessage());
        }

    }
    public function updateUserById(int $id, UserUpdateDTO $user){


    }
    public function deleteUserById(int $id){

    }

}

?>