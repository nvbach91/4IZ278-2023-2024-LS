<?php
require_once './classes/DatabaseConnection.php';
require_once './classes/DatabaseOperations.php';

abstract class Database implements DatabaseOperations {
    protected $pdo;

    public function __construct() {
        $dbConnection = DatabaseConnection::getInstance();
        $this->pdo = $dbConnection->getPDO();
    }
}
?>