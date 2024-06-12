<?php
require_once __DIR__ . '/DatabaseConnection.php';

 abstract class DB {
    protected $db;

    public function __construct()
    {

        $this->db = DatabaseConnection::getPDOConnection();
    }

}
