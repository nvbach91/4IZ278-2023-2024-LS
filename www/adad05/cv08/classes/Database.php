<?php

require_once 'DatabaseOperations.php';
require_once 'DatabaseConnection.php';

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    protected function runQuery($sql, $data)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        // return a fetchAll() slouží pouze pro případ SELECTu, takže pokud zavolám třeba INSERT, nic se nevrátí, což je správně
        return $statement->fetchAll();
    }
}
