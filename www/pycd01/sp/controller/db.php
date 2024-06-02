<?php
    const DB_SERVERNAME = "localhost";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "pycd01";


interface CRUD {
    public function create($obj);
    public function read($id);
    public function readAll();
    public function update($obj, $id);
    public function delete($obj);
  }
abstract class Database implements CRUD {

    protected $tableName;
    protected static $DB;

    public function __construct() {
        self::getInstance();
    }

    public static function getInstance() {

        if(!isset(self::$DB)) {
            self::$DB = new PDO('mysql:host='.DB_SERVERNAME.';dbname='. DB_NAME, DB_USERNAME, DB_PASSWORD);
        }
        return self::$DB;
    }

    public function __destruct() {
        self::$DB = null;
    }
    
    public function showDBSettings()
    {
        return 'Server Name: '.DB_SERVERNAME.'Username: '.DB_USERNAME.'Password: '.DB_PASSWORD.'Database Name: '.DB_NAME;
    }

    public function readAll()
    {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function read($id)
    {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName.' WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function delete($id) 
    {
        $statement = self::$DB->prepare('DELETE FROM '.$this->tableName.' WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

    }
    
}
