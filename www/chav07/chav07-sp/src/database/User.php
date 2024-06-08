<?php 

require_once __DIR__ . "/../authentication/AuthUtils.php";


class User{

    public int $id;
    public string $email;
    public string $name;
    public ?string $password;
    public AuthRole $role;

    public function __construct(int $id, string $email, string $name, ?string $password, AuthRole $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->role = $role;
    }

}


?>