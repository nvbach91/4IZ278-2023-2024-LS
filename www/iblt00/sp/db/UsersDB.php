<?php require __DIR__ . '/Database.php'; ?>
<?php

class UserDB extends Database
{
    protected $tableName = 'sp_users';
    public function create($data)
    {
        $sql = "INSERT INTO $this->tableName (first_name, last_name, email, password, type, dob, address, phone) VALUES (:name, :lastName, :email, :password, :type, :dob, :address, :phone)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $data['name'],
            'lastname' => $data['lastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'type' => $data['type'],
            'dob' => $data['dob'],
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);
    }
    public function findByEmail($email)
    {
        return $this->fetchBy('email', $email);
    }
    public function findByLastName($lastname)
    {
        return $this->fetchBy('last_name', $lastname);
    }
    public function findByUserType($type)
    {
        return $this->fetchBy('type', $type);
    }
    public function findByUserActive($active)
    {
        return $this->fetchBy('active', $active);
    }
}
?>