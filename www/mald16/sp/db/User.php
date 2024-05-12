<?php

require_once "./db/db.php";

class User {
    public $name;
    public $email;
    public $role;
    public $org_id;
    public $notifOptIn;

    public function __construct($email, $org_id = null) {
        $this->email = $email;
        $this->org_id = $org_id == null ? null : $org_id;
        $this->name = $this->getUser() != false ? $this->getUser()["name"] : null;
        $this->role = $org_id == null ? null : $this->getUserInOrg()["role"];
        $this->notifOptIn = $this->getUser() != false ? $this->getUser()["notif_opt_in"] : null;
    }

    public function getOrganizations() {
        global $db;
        $stmt = $db->prepare("SELECT organizations.org_id, organizations.org_name, org_users.role FROM organizations JOIN org_users ON organizations.org_id = org_users.org_id WHERE org_users.email = :email");
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUser() {
        global $db;
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :uid");
        $stmt->bindParam(":uid", $this->email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUserInOrg() {
        global $db;
        $stmt = $db->prepare("SELECT * FROM org_users WHERE email = :email AND org_id = :oid");
        $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindValue(":oid", $this->org_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function getRole($returnName = false) {
        if ($returnName) {
            $roleNum = $this->getUserInOrg($this->email, $this->org_id)["role"];

            switch ($roleNum) {
                case 1:
                    return "klient";
                case 2:
                    return "producent";
                case 3:
                    return "administrátor";
            }
        }
        return $this->getUserInOrg($this->email, $this->org_id)["role"];
    }

    public function getSongs() {
        global $db;
        // Vrací i jména producentů a klientů, jméno organizace
        $stmt = $db->prepare("SELECT 
        s.song_id,
        s.org_id,
        o.org_name,
        s.date,
        s.client,
        s.producer,
        s.name AS song_name,
        uc.name AS client_name,
        up.name AS producer_name
    FROM 
        songs s
    LEFT JOIN 
        org_users oc ON s.client = oc.org_user_id  -- Join for client through org_users
    LEFT JOIN 
        users uc ON oc.email = uc.email  -- Join to get client details
    LEFT JOIN 
        org_users op ON s.producer = op.org_user_id  -- Join for producer through org_users
    LEFT JOIN 
        users up ON op.email = up.email  -- Join to get producer details
    LEFT JOIN 
        organizations o ON s.org_id = o.org_id  -- Join for organization name
    WHERE 
        oc.email = :email OR op.email = :email;      
    ");
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function addUser($email) {
        global $db;
        $stmt = $db->prepare("INSERT INTO users (email) VALUES (:email)");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function addUserToOrg($email) {
        global $db;
        $stmt = $db->prepare("INSERT INTO org_users (org_id, email, role) VALUES (:oid, :email, :role)");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":oid", $this->org_id, PDO::PARAM_INT);
        $stmt->bindValue(":role", 1, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateNonregisteredUser($name, $password, $email) {
        global $db;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET name = :name, password = :password WHERE email = :email");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function registerUser($name, $email, $password) {
        global $db;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (email, name, password) VALUES (:email, :name, :password)");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteUserFromOrg() {
        global $db;
        $stmt = $db->prepare("DELETE FROM org_users WHERE email = :email AND org_id = :oid");
        $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindValue(":oid", $this->org_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateUser($notifOptIn) {
        global $db;

        $stmt = $db->prepare("UPDATE users SET name = :name, notif_opt_in = :noi WHERE email = :email");
        $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindValue(":noi", $notifOptIn, PDO::PARAM_INT);
        $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateUserRole($role) {
        global $db;
        $stmt = $db->prepare("UPDATE org_users SET role = :role WHERE org_id = :oid AND email = :uid");
        $stmt->bindValue(":role", $role, PDO::PARAM_INT);
        $stmt->bindValue(":oid", $this->org_id, PDO::PARAM_INT);
        $stmt->bindValue(":uid", $this->email, PDO::PARAM_STR);
        return $stmt->execute();
    }
}