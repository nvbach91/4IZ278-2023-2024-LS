<?php
require_once './classes/Database.php';

class EnrollmentsDB extends Database {

    public function create($data) {
        $statement = $this->pdo->prepare("
            INSERT INTO Enrollments (student_id, course_id) 
            VALUES (:student_id, :course_id)
        ");
        $statement->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
        $statement->bindParam(':course_id', $data['course_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function find($enrollment_id) {
        $statement = $this->pdo->prepare("SELECT * FROM Enrollments WHERE enrollment_id = :enrollment_id");
        $statement->bindParam(':enrollment_id', $enrollment_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findByStudentAndCourse($student_id, $course_id) {
        $statement = $this->pdo->prepare("
        SELECT * FROM Enrollments 
        WHERE student_id = :student_id AND course_id = :course_id");
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $statement = $this->pdo->prepare("
            UPDATE Enrollments 
            SET student_id = :student_id, course_id = :course_id 
            WHERE enrollment_id = :enrollment_id
        ");
        $statement->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
        $statement->bindParam(':course_id', $data['course_id'], PDO::PARAM_INT);
        $statement->bindParam(':enrollment_id', $data['enrollment_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($enrollment_id) {
        $statement = $this->pdo->prepare("DELETE FROM Enrollments WHERE enrollment_id = :enrollment_id");
        $statement->bindParam(':enrollment_id', $enrollment_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function deleteByStudentAndCourse($student_id, $course_id) {
        $statement = $this->pdo->prepare("DELETE FROM Enrollments WHERE student_id = :student_id AND course_id = :course_id");
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function deleteByStudent($student_id) {
        $statement = $this->pdo->prepare("DELETE FROM Enrollments WHERE student_id = :student_id");
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function getStudentsByCourseId($course_id) {
        $statement = $this->pdo->prepare("
            SELECT u.user_id, u.first_name, u.last_name 
            FROM Users u 
            JOIN Enrollments e ON u.user_id = e.student_id 
            WHERE e.course_id = :course_id
        ");
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
