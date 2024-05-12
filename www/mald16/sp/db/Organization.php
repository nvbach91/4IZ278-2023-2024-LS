<?php

require_once "./db/db.php";

class Organization {
    public $orgId;
    public $orgName;

    public function __construct($orgId) {
        $this->orgId = $orgId;
        $this->orgName = $this->getOrganization()["org_name"];
    }

    public static function createOrganization($name, $owner, $returnId = false) {
        global $db;
        $stmt = $db->prepare("INSERT INTO organizations (org_name) VALUES (:org_name)");
        $stmt->bindValue(":org_name", $name, PDO::PARAM_STR);
        $stmt->execute();
        $orgId = $db->lastInsertId();

        $stmt = $db->prepare("INSERT INTO org_users (org_id, email, role) VALUES (:org_id, :email, 3)");
        $stmt->bindValue(":org_id", $orgId, PDO::PARAM_INT);
        $stmt->bindValue(":email", $owner, PDO::PARAM_STR);
        $success = $stmt->execute();

        if ($returnId) {
            return $orgId;
        }
        return $success;
    }

    public function updateOrganizationName($newName) {
        global $db;
        $stmt = $db->prepare("UPDATE organizations SET org_name = :newname WHERE org_id = :oid");
        $stmt->bindValue(":newname", $newName, PDO::PARAM_STR);
        $stmt->bindValue(":oid", $this->orgId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getOrganization() {
        global $db;
        $stmt = $db->prepare("SELECT * FROM organizations WHERE org_id = :oid");
        $stmt->bindValue(":oid", $this->orgId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getService($sid) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM org_services WHERE service_id = :sid");
        $stmt->bindValue(":sid", $sid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getSongs() {
        global $db;
        $stmt = $db->prepare("SELECT * FROM songs WHERE org_id = :oid");
        $stmt->bindValue(":oid", $this->orgId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getServices() {
        global $db;
        $stmt = $db->prepare("SELECT * FROM org_services WHERE org_id = :oid");
        $stmt->bindValue(":oid", $this->orgId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUsers($role = null) {
        global $db;
        $baseQuery = "SELECT org_users.org_user_id, org_users.email, org_users.role, users.name FROM org_users JOIN users ON org_users.email = users.email WHERE org_users.org_id = :oid";

        if ($role !== null) {
            $baseQuery .= " AND org_users.role = :role";
        }

        $stmt = $db->prepare($baseQuery);
        $stmt->bindValue(":oid", $this->orgId, PDO::PARAM_INT);

        if ($role !== null) {
            $stmt->bindValue(":role", $role, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addService($servName) {
        global $db;
        $stmt = $db->prepare("INSERT INTO org_services (org_id, service_name) VALUES (:oid,  :servname)");
        $stmt->bindValue(":oid", $this->orgId, PDO::PARAM_INT);
        $stmt->bindValue(":servname", $servName, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteService($sid) {
        global $db;
        $db->beginTransaction();

        $deleteDependents = $db->prepare("DELETE FROM song_services WHERE org_service_id = :service_id");
        $deleteDependents->bindValue(':service_id', $sid, PDO::PARAM_INT);
        $deleteDependents->execute();

        $deleteService = $db->prepare("DELETE FROM org_services WHERE service_id = :service_id");
        $deleteService->bindValue(':service_id', $sid, PDO::PARAM_INT);
        $deleteService->execute();

        return $db->commit();
    }
}
