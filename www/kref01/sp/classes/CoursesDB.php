<?php
require_once 'Database.php';
require_once 'DatabaseOperations.php';

class CoursesDB extends Database implements DatabaseOperations {

    public function create($data) {
        $statement = $this->pdo->prepare("
            INSERT INTO Courses (course_name)
            VALUES (:course_name)
        ");
        $statement->bindParam(':course_name', $data['course_name'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function find($id) {
        $statement = $this->pdo->prepare("SELECT * FROM Courses WHERE course_id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $statement = $this->pdo->prepare("
            UPDATE Courses 
            SET course_name = :course_name
            WHERE course_id = :course_id
        ");
        $statement->bindParam(':course_name', $data['course_name'], PDO::PARAM_STR);
        $statement->bindParam(':course_id', $data['course_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($id) {
        $statement = $this->pdo->prepare("DELETE FROM Courses WHERE course_id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getCoursesByTeacherId($teacher_id) {
        $statement = $this->pdo->prepare("
            SELECT c.course_id, c.course_name
            FROM Courses c
            JOIN CourseTeachers ct ON ct.course_id = c.course_id
            WHERE ct.teacher_id = :teacher_id
        ");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCourses() {
        $statement = $this->pdo->prepare("SELECT * FROM Courses");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeachersByCourseId($course_id) {
        $statement = $this->pdo->prepare("
            SELECT u.user_id, u.first_name, u.last_name 
            FROM Users u 
            JOIN CourseTeachers ct ON u.user_id = ct.teacher_id 
            WHERE ct.course_id = :course_id
        ");
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
