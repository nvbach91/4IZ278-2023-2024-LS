<?php

require_once 'DatabaseOperations.php';
require_once 'DatabaseConnection.php';

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $pdo = DatabaseConnection::getPDOConnection();
    }
}
