<?php
require "DatabaseConnection.php";
require "DatabaseOperations.php";
abstract class Database implements DatabaseOperations
{
    //protected PDO $pdo;
   public function __construct()
   {
     //$pdo = DatabaseConnection::getPDOConnection();
   }
    
}
?>