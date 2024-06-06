<?php
require_once './classes/Database.php';

class ParenthoodDB extends Database {

    public function create($data) {
        $statement = $this->pdo->prepare(
            "INSERT INTO Parenthood (student_id, parent_id) 
            VALUES (:student_id, :parent_id);"
        );
        $statement->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
        $statement->bindParam(':parent_id', $data['parent_id'], PDO::PARAM_INT);
        
        $statement->execute();
        echo "Parenthood record created with ID: " . $this->pdo->lastInsertId() . "<br>";
    }

    public function find($parenthood_id) {
        $statement = $this->pdo->prepare("SELECT * FROM Parenthood WHERE parenthood_id = :parenthood_id;");
        $statement->bindParam(':parenthood_id', $parenthood_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findByParentAndStudent($parent_id, $student_id) {
        $statement = $this->pdo->prepare("SELECT parenthood_id FROM Parenthood WHERE parent_id = :parent_id AND student_id = :student_id");
        $statement->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $statement = $this->pdo->prepare(
            "UPDATE Parenthood SET 
            student_id = :student_id, 
            parent_id = :parent_id 
            WHERE parenthood_id = :parenthood_id;"
        );
        
        $statement->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
        $statement->bindParam(':parent_id', $data['parent_id'], PDO::PARAM_INT);
        $statement->bindParam(':parenthood_id', $data['parenthood_id'], PDO::PARAM_INT);
    
        $statement->execute();
    }

    public function delete($parenthood_id) {
        $statement = $this->pdo->prepare("DELETE FROM Parenthood WHERE parenthood_id = :parenthood_id;");
        $statement->bindParam(':parenthood_id', $parenthood_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteByParentAndStudent($parent_id, $student_id) {
        $statement = $this->pdo->prepare("DELETE FROM Parenthood WHERE parent_id = :parent_id AND student_id = :student_id");
        $statement->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function deleteByStudent($student_id) {
        $statement = "DELETE FROM Parenthood WHERE student_id = :student_id";
        $statement = $this->pdo->prepare($statement);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function deleteByParent($parent_id) {
        $statement = "DELETE FROM Parenthood WHERE parent_id = :parent_id";
        $statement = $this->pdo->prepare($statement);
        $statement->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function getAllParenthoods() {
        $statement = $this->pdo->prepare("SELECT * FROM Parenthood;");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChildrenByParentId($parent_id) {
        $statement = $this->pdo->prepare("
            SELECT u.first_name, u.last_name
            FROM Users u 
            JOIN Parenthood p ON p.student_id = u.user_id
            WHERE p.parent_id = :parent_id;
        ");
        $statement->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
