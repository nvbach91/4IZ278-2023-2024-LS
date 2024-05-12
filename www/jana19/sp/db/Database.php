<?php 
require __DIR__ .'/DatabaseOperations.php';
require __DIR__ .'/DatabaseConnection.php';

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }

    // přidat funkce

    
}
?>