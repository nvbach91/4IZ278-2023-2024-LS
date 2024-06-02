<?php 
require_once __DIR__ . "/../../authentication/AuthUtils.php";


class UserUpdateDTO {

    public string $email;
    public string $name;
    public ?string $password;
    public AuthRole $role;

    public function __construct(string $email, string $name, ?string $password, AuthRole $role)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->role = $role;
    }
}

?>