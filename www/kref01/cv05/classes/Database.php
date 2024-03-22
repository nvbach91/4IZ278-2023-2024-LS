<?php
require_once './classes/DatabaseConnection.php';
require_once './classes/DatabaseOperations.php';

abstract class Database implements DatabaseOperations {
    private $dbCon;
    public function __construct() {
        $this->dbCon = DatabaseConnection::getInstance();
    }
}
?>