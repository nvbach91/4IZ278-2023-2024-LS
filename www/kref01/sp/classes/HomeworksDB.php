<?php
require_once './classes/Database.php';

class HomeworksDB extends Database {
    
    public function create($data) {
        $statement = $this->pdo->prepare(
            "INSERT INTO Homeworks (assignment_id, graded_by, student_id, content, grade, status) 
            VALUES (:assignment_id, :graded_by, :student_id, :content, :grade, :status);"
        );
        $statement->bindParam(':assignment_id', $data['assignment_id'], PDO::PARAM_INT);
        $statement->bindParam(':graded_by', $data['graded_by'], PDO::PARAM_INT);
        $statement->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
        $statement->bindParam(':content', $data['content'], PDO::PARAM_STR);
        $statement->bindParam(':grade', $data['grade'], PDO::PARAM_STR);
        $statement->bindParam(':status', $data['status'], PDO::PARAM_STR);
        
        $statement->execute();
        echo "Homework created with ID: " . $this->pdo->lastInsertId() . "<br>";
    }

    public function find($homework_id) {
        $statement = $this->pdo->prepare("SELECT * FROM Homeworks WHERE homework_id = :homework_id;");
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getHomeworksByStudentId($student_id) {
        $statement = $this->pdo->prepare("
            SELECT h.homework_id, h.status, a.assignment_id, a.short_description, a.date_assigned, c.course_name 
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Courses c ON c.course_id = a.course_id
            WHERE h.student_id = :student_id
            ORDER BY a.date_assigned ASC;
        ");
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHomeworksByTeacherId($teacher_id) {
        $statement = $this->pdo->prepare("
            SELECT h.homework_id, u.first_name, u.last_name, h.status, a.assignment_id, a.short_description, a.date_assigned, c.course_name 
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Courses c ON c.course_id = a.course_id
            JOIN Users u ON u.user_id = h.student_id
            WHERE a.teacher_id = :teacher_id
            ORDER BY a.date_assigned ASC;
        ");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllHomeworks() {
        $statement = $this->pdo->prepare("
            SELECT h.homework_id, u.first_name, u.last_name, h.status, a.assignment_id, a.short_description, a.date_assigned, c.course_name 
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Courses c ON c.course_id = a.course_id
            JOIN Users u ON u.user_id = h.student_id
            ORDER BY a.date_assigned ASC;
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHomeworkByHomeworkIdAndStudentId($homework_id, $student_id) {
        $statement = $this->pdo->prepare("
            SELECT h.assignment_id, h.content, h.status, h.grade, a.short_description, a.long_description, a.date_assigned, c.course_name 
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Courses c ON c.course_id = a.course_id
            WHERE h.homework_id = :homework_id AND h.student_id = :student_id;
        ");
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getHomeworkByHomeworkIdAndTeacherId($homework_id, $teacher_id) {
        $statement = $this->pdo->prepare("
            SELECT h.homework_id, h.content, h.status, h.grade, h.student_id, a.short_description, a.long_description, a.date_assigned, c.course_name 
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Courses c ON c.course_id = a.course_id
            WHERE h.homework_id = :homework_id AND a.teacher_id = :teacher_id;
        ");
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getHomeworkByHomeworkId($homework_id) {
        $statement = $this->pdo->prepare("
            SELECT h.homework_id, h.content, h.status, h.grade, h.student_id, a.short_description, a.long_description, a.date_assigned, c.course_name 
            FROM Homeworks h 
            JOIN Assignments a ON a.assignment_id = h.assignment_id
            JOIN Courses c ON c.course_id = a.course_id
            WHERE h.homework_id = :homework_id
        ");
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $statement = $this->pdo->prepare(
            "UPDATE Homeworks SET 
            assignment_id = :assignment_id, 
            graded_by = :graded_by, 
            student_id = :student_id, 
            content = :content, 
            grade = :grade, 
            status = :status 
            WHERE homework_id = :homework_id;"
        );
        
        $statement->bindParam(':assignment_id', $data['assignment_id'], PDO::PARAM_INT);
        $statement->bindParam(':graded_by', $data['graded_by'], PDO::PARAM_INT);
        $statement->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
        $statement->bindParam(':content', $data['content'], PDO::PARAM_STR);
        $statement->bindParam(':grade', $data['grade'], PDO::PARAM_STR);
        $statement->bindParam(':status', $data['status'], PDO::PARAM_STR);
        $statement->bindParam(':homework_id', $data['homework_id'], PDO::PARAM_INT);
    
        $statement->execute();
        echo "Homework updated: " . $data['homework_id'] . "<br>";
    }

    public function updateHomeworkContent($homework_id, $student_id, $content) {
        $statement = $this->pdo->prepare("
            UPDATE Homeworks 
            SET content = :content, status = 'submitted' 
            WHERE homework_id = :homework_id AND student_id = :student_id
        ");
        $statement->bindParam(':content', $content, PDO::PARAM_STR);
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function updateHomeworkGrade($homework_id, $student_id, $grade) {
        $statement = $this->pdo->prepare("
            UPDATE Homeworks 
            SET status = 'graded', grade = :grade
            WHERE homework_id = :homework_id AND student_id = :student_id
        ");
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->bindParam(':grade', $grade, PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete($homework_id) {
        $statement = $this->pdo->prepare("DELETE FROM Homeworks WHERE homework_id = :homework_id;");
        $statement->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
    
        $statement->execute();
        echo "Homework deleted: " . $homework_id . "<br>";
    }
}
?>
