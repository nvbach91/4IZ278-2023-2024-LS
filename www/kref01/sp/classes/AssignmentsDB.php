<?php
require_once './classes/Database.php';

class AssignmentsDB extends Database {
    public function create($data) {
        $statement = $this->pdo->prepare("
            INSERT INTO Assignments (course_id, teacher_id, short_description, long_description, date_assigned)
            VALUES (:course_id, :teacher_id, :short_description, :long_description, :date_assigned)
        ");
        $statement->bindParam(':course_id', $data['course_id'], PDO::PARAM_INT);
        $statement->bindParam(':teacher_id', $data['teacher_id'], PDO::PARAM_INT);
        $statement->bindParam(':short_description', $data['short_description'], PDO::PARAM_STR);
        $statement->bindParam(':long_description', $data['long_description'], PDO::PARAM_STR);
        $statement->bindParam(':date_assigned', $data['date_assigned'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function createAssignment($course_id, $teacher_id, $short_description, $long_description, $date_assigned) {
        $statement = $this->pdo->prepare("
            INSERT INTO Assignments (course_id, teacher_id, short_description, long_description, date_assigned)
            VALUES (:course_id, :teacher_id, :short_description, :long_description, :date_assigned)
        ");
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->bindParam(':short_description', $short_description, PDO::PARAM_STR);
        $statement->bindParam(':long_description', $long_description, PDO::PARAM_STR);
        $statement->bindParam(':date_assigned', $date_assigned, PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
    
    public function createHomework($assignment_id, $student_id) {
        $statement = $this->pdo->prepare("
            INSERT INTO Homeworks (assignment_id, student_id, status)
            VALUES (:assignment_id, :student_id, 'assigned')
        ");
        $statement->bindParam(':assignment_id', $assignment_id, PDO::PARAM_INT);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function find($assignment_id) {
        echo "find -$assignment_id- [AssignmentsDB] <br>";
        $statement = $this->pdo->prepare("SELECT * FROM Assignments WHERE assignment_id = :assignment_id;");
        $statement->bindParam(':assignment_id', $assignment_id, PDO::PARAM_INT);
        $statement->execute();
        $assignments = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($assignments as $value) {
            echo $value['assignment_id'] . " | " . $value['description'] . "<br>";
        }
    }

    public function update($data) {
        echo "update - assignment ID: " . $data['assignment_id'] . " [AssignmentsDB] <br>";
        $statement = $this->pdo->prepare(
            "UPDATE Assignments SET 
            teacher_id = :teacher_id, 
            description = :description, 
            solution = :solution, 
            date_assigned = :date_assigned 
            WHERE assignment_id = :assignment_id;"
        );
        
        $statement->bindParam(':teacher_id', $data['teacher_id'], PDO::PARAM_INT);
        $statement->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $statement->bindParam(':solution', $data['solution'], PDO::PARAM_STR);
        $statement->bindParam(':date_assigned', $data['date_assigned'], PDO::PARAM_STR);
        $statement->bindParam(':assignment_id', $data['assignment_id'], PDO::PARAM_INT);
    
        $statement->execute();
        echo "Assignment updated: " . $data['assignment_id'] . "<br>";
    }

    public function delete($assignment_id) {
        $statement = $this->pdo->prepare("DELETE FROM Assignments WHERE assignment_id = :assignment_id;");
        $statement->bindParam(':assignment_id', $assignment_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getGradesByStudentId($student_id) {
        $statement = $this->pdo->prepare("
            SELECT a.short_description, h.grade, h.status
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Users u ON u.user_id = h.student_id
            WHERE h.student_id = :student_id
            ORDER BY h.submitted_at DESC;
        ");
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGradesByParentId($parent_id) {
        $statement = $this->pdo->prepare("
            SELECT u.user_id, u.first_name, u.last_name, a.short_description, h.grade, h.status, h.submitted_at
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Users u ON u.user_id = h.student_id
            JOIN Parenthood p ON p.student_id = u.user_id
            WHERE p.parent_id = :parent_id
            ORDER BY h.submitted_at DESC;
        ");
        $statement->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGradesByTeacherId($teacher_id) {
        $statement = $this->pdo->prepare("
            SELECT DISTINCT u.user_id, u.first_name, u.last_name, a.assignment_id, h.grade, h.status, h.submitted_at
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Users u ON u.user_id = h.student_id
            JOIN CourseTeachers ct ON ct.course_id = a.course_id
            WHERE a.teacher_id = :teacher_id
            ORDER BY u.last_name, u.first_name ASC;
        ");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGrades() {
        $statement = $this->pdo->prepare("
            SELECT u.user_id, u.first_name, u.last_name, a.assignment_id, h.grade, h.status
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Users u ON u.user_id = h.student_id;
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByTeacherId($teacher_id) {
        $statement = $this->pdo->prepare("
        DELETE FROM Assignments
        WHERE teacher_id = :teacher_id;");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
