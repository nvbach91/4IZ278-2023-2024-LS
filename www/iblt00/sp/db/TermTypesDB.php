<?php require __DIR__ . '/Database.php'; ?>
<?php

class UserDB extends Database
{
    protected $tableName = 'sp_term_types';
    public function create($data)
    {
        $sql = "INSERT INTO $this->tableName (name, specification) VALUES (:name, :specification)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $data['termTypeName'],
            'specification' => $data['termTypeSpecification'],
        ]);
    }
    public function findByTermName($termName)
    {
        return $this->fetchBy('name', $termName);
    }
    public function findByTermActive($termActive)
    {
        return $this->fetchBy('active', $termActive);
    }
}

?>