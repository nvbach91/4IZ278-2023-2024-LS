 <?php

const DB_SERVERNAME = "localhost";
const DB_USERNAME = "pycd01";
const DB_PASSWORD = "EeMethius9ohj3eino";
const DB_NAME = "pycd01";

interface CRUD {
    public function create($obj);
    public function read();
    public function update($obj);
    public function delete($obj);
  }
abstract class Database implements CRUD {
    protected $DB;

    public function __construct() {
        $this->DB = new PDO('mysql:host='.DB_SERVERNAME.';dbname='. DB_NAME, DB_USERNAME, DB_PASSWORD);
    }

    public function __destruct() {
        $this->DB = null;
    }
    
    public function showDBSettings()
    {
        return 'Server Name: '.DB_SERVERNAME.'Username: '.DB_USERNAME.'Password: '.DB_PASSWORD.'Database Name: '.DB_NAME;
    }
    
}
