<?php require __DIR__ . '/Database.php'; ?>
<?php

class UserDB extends Database
{
    protected $tableName = 'sp_reservation_states';
    public function create($data)
    {
        $sql = "INSERT INTO $this->tableName (name, specification) VALUES (:name, :specification)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $data['resStateName'],
            'specification' => $data['resStateSpecification'],
        ]);
    }
    public function findByResStateName($resStateName)
    {
        return $this->fetchBy('name', $resStateName);
    }
    public function findByResStateActive($resStateActive)
    {
        return $this->fetchBy('active', $resStateActive);
    }
}

?>