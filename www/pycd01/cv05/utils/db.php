 <?php

const DB_SERVERNAME = "localhost";
const DB_USERNAME = "pycd01";
const DB_PASSWORD = "";
const DB_NAME = "pycd01";

interface CRUD {
    public function create($obj);
    public function read();
    public function update($obj);
    public function delete($obj);
  }
abstract class Database implements CRUD {
    private static $DB;

    protected function __construct() {
        
    }
    public static function getInstance() {
        if(!isset(self::$DB)) {
            self::$DB = new PDO('mysql:host='.DB_SERVERNAME.';dbname='. DB_NAME, DB_USERNAME, DB_PASSWORD);
        }
        return self::$DB;
    }

    protected function __destruct() {
        self::$DB = null;
    }
    
    public function showDBSettings()
    {
        return 'Server Name: '.DB_SERVERNAME.'Username: '.DB_USERNAME.'Password: '.DB_PASSWORD.'Database Name: '.DB_NAME;
    }
    
}
