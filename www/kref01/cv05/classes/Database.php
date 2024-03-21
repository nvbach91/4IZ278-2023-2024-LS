<?php

abstract class Database implements DatabaseOperations {
    private $dbCon;
    public function __construct() {
        $this->dbCon = DatabaseConnection::getInstance();
    }
}
?>