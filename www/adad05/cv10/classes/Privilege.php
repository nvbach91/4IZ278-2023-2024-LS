<?php

require 'classes/UsersDB.php';
class Privilege
{
    function getPrivilege()
    {
        if (isset($_COOKIE['username'])) {
            $email = $_COOKIE['username'];
            $usersDB = new UsersDB();
            $privilege = $usersDB->findByEmail($email)[0]['privilege'];
            return $privilege;
        } else {
            return 0;
        }
    }

    function isManager()
    {
        $privilege = $this->getPrivilege();
        if ($privilege < 1) {
            return false;
        } else {
            return true;
        }
    }

    function isAdmin()
    {
        $privilege = $this->getPrivilege();
        if ($privilege < 2) {
            return false;
        } else {
            return true;
        }
    }
}
