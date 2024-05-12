<?php require __DIR__ . '/Database.php'; ?>
<?php

class UserDB extends Database
{
    protected $tableName = 'sp_workers';
    public function create($data)
    {
        $sql = "INSERT INTO $this->tableName (nickname, full_name) VALUES (:nickname, :fullname)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'nickname' => $data['workerNick'],
            'fullname' => $data['workerName'],
        ]);
    }
    public function findByNick($workerNick)
    {
        return $this->fetchBy('nickname', $workerNick);
    }
    public function findByName($workerName)
    {
        return $this->fetchBy('full_name', $workerName);
    }
}

?>