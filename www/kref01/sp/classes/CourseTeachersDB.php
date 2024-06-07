<?php
require_once './classes/Database.php';

class CourseTeachersDB extends Database {

    public function create($data) {
        $statement = $this->pdo->prepare("
            INSERT INTO CourseTeachers (teacher_id, course_id) 
            VALUES (:teacher_id, :course_id)
        ");
        $statement->bindParam(':teacher_id', $data['teacher_id'], PDO::PARAM_INT);
        $statement->bindParam(':course_id', $data['course_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function find($course_teacher_id) {
        $statement = $this->pdo->prepare("SELECT * FROM CourseTeachers WHERE course_teacher_id = :course_teacher_id");
        $statement->bindParam(':course_teacher_id', $course_teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findByTeacherAndCourse($teacher_id, $course_id) {
        $statement = $this->pdo->prepare("SELECT * FROM CourseTeachers WHERE teacher_id = :teacher_id AND course_id = :course_id");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $statement = $this->pdo->prepare("
            UPDATE CourseTeachers 
            SET teacher_id = :teacher_id, course_id = :course_id 
            WHERE course_teacher_id = :course_teacher_id
        ");
        $statement->bindParam(':teacher_id', $data['teacher_id'], PDO::PARAM_INT);
        $statement->bindParam(':course_id', $data['course_id'], PDO::PARAM_INT);
        $statement->bindParam(':course_teacher_id', $data['course_teacher_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($course_teacher_id) {
        $statement = $this->pdo->prepare("DELETE FROM CourseTeachers WHERE course_teacher_id = :course_teacher_id");
        $statement->bindParam(':course_teacher_id', $course_teacher_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteByTeacherAndCourse($teacher_id, $course_id) {
        $statement = $this->pdo->prepare("DELETE FROM CourseTeachers WHERE teacher_id = :teacher_id AND course_id = :course_id");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function deleteByTeacherId($teacher_id) {
        $statement = "DELETE FROM CourseTeachers WHERE teacher_id = :teacher_id";
        $statement = $this->pdo->prepare($statement);
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        return $statement->execute();
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
}
?>
