<?php 

require_once __DIR__ . "/User.php";
require_once __DIR__ . "/DTOs/UserUpdateDTO.php";
require_once __DIR__ . "/DTOs/UserCreateDTO.php";

interface IUserRepository{

    public function getUserByEmail(string $email) : ?User;
    public function getUserById(int $id) : ?User;
    public function createUser(UserCreateDTO $user);
    public function updateUserById(int $id, UserUpdateDTO $user);
    public function deleteUserById(int $id);
}

?>