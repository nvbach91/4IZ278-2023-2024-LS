<?php
require_once './classes/Database.php';

class UsersDB extends Database {
    public function create($data) {
        $statement = $this->pdo->prepare("
            INSERT INTO Users (first_name, middle_name, last_name, email, date_of_birth, role, password) 
            VALUES (:first_name, :middle_name, :last_name, :email, :date_of_birth, :role, :password)
        ");
        $statement->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $statement->bindParam(':middle_name', $data['middle_name'], PDO::PARAM_STR);
        $statement->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindParam(':date_of_birth', $data['date_of_birth'], PDO::PARAM_STR);
        $statement->bindParam(':role', $data['role'], PDO::PARAM_STR);
        $statement->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
    
    public function emailExists($email) {
        $statement = $this->pdo->prepare("SELECT * FROM Users WHERE email = :email;");
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function find($user_id) {
        $statement = $this->pdo->prepare("SELECT * FROM Users WHERE user_id = :user_id;");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $statement = $this->pdo->prepare("SELECT * FROM Users WHERE email = :email;");
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $statement = $this->pdo->prepare("SELECT * FROM Users;");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleById($user_id) {
        $statement = $this->pdo->prepare("SELECT role FROM Users WHERE user_id = :user_id;");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsersByRole($role) {
        $statement = $this->pdo->prepare("SELECT * FROM Users WHERE role = :role;");
        $statement->bindParam(':role', $role, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesByTeacherId($teacher_id) {
        $statement = $this->pdo->prepare("
            SELECT c.course_id, c.course_name
            FROM Courses c
            JOIN CourseTeachers ct ON c.course_id = ct.course_id
            WHERE ct.teacher_id = :teacher_id
        ");
        $statement->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesByStudentId($student_id) {
        $statement = $this->pdo->prepare("
            SELECT c.course_id, c.course_name
            FROM Courses c
            JOIN Enrollments e ON c.course_id = e.course_id
            WHERE e.student_id = :student_id
        ");
        $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentsByCourseId($course_id) {
        $statement = $this->pdo->prepare("
            SELECT u.user_id FROM Users u
            JOIN Enrollments e ON u.user_id = e.student_id
            WHERE e.course_id = :course_id
        ");
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $statement = $this->pdo->prepare(
            "UPDATE Users SET 
            role = :role, 
            first_name = :first_name, 
            middle_name = :middle_name, 
            last_name = :last_name, 
            email = :email, 
            date_of_birth = :date_of_birth 
            WHERE user_id = :user_id;"
        );
        
        $statement->bindParam(':role', $data['role'], PDO::PARAM_STR);
        $statement->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $statement->bindParam(':middle_name', $data['middle_name'], PDO::PARAM_STR);
        $statement->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindParam(':date_of_birth', $data['date_of_birth'], PDO::PARAM_STR);
        $statement->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
    
        $statement->execute();
    }

    public function delete($user_id) {
        $statement = $this->pdo->prepare("DELETE FROM Users WHERE user_id = :user_id;");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $statement->execute();
    }
}
?>