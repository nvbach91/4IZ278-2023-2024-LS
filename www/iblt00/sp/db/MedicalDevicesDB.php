<?php require __DIR__ . '/Database.php'; ?>
<?php

class MedicalDevicesDB extends Database
{
    protected $tableName = 'sp_medical_devices';
    public function create($data)
    {
        $sql = "INSERT INTO $this->tableName (code, name) VALUES (:codeMD, :nameMD)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'codeMD' => $data['codeMD'],
            'nameMD' => $data['nameMD'],
        ]);
    }
    public function findByMdCode($mdCode)
    {
        return $this->fetchBy('code', $mdCode);
    }
    public function findByMdName($mdName)
    {
        return $this->fetchBy('name', $mdName);
    }
    public function findByMdActive($mdActive)
    {
        return $this->fetchBy('active', $mdActive);
    }
}

?>