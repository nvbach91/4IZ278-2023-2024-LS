-- ------------------------------ DROP TABLES --------------------------------

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS Homeworks;
DROP TABLE IF EXISTS Assignments;
DROP TABLE IF EXISTS CourseTeachers;
DROP TABLE IF EXISTS Enrollments;
DROP TABLE IF EXISTS Parenthood;
DROP TABLE IF EXISTS Courses;
DROP TABLE IF EXISTS Users;

SET FOREIGN_KEY_CHECKS = 1;

-- ------------------------------ TABLE USERS --------------------------------

CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    role ENUM('student', 'teacher', 'parent', 'admin') DEFAULT 'student',
    first_name VARCHAR(255),
    middle_name VARCHAR(255) NULL,
    last_name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    date_of_birth DATE
);

-- ------------------------------ TABLE COURSES --------------------------------

CREATE TABLE Courses (
    course_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(255) NOT NULL,
    description TEXT
);

-- ------------------------------ TABLE ENROLLMENTS --------------------------------

CREATE TABLE Enrollments (
    enrollment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    student_id INTEGER,
    course_id INTEGER,
    FOREIGN KEY (student_id) REFERENCES Users(user_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

-- ------------------------------ TABLE COURSE TEACHERS --------------------------------

CREATE TABLE CourseTeachers (
    course_teacher_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    teacher_id INTEGER,
    course_id INTEGER,
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

-- ------------------------------ TABLE ASSIGNMENTS --------------------------------

CREATE TABLE Assignments (
    assignment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    course_id INTEGER,
    teacher_id INTEGER,
    short_description TEXT,
    long_description TEXT,
    date_assigned DATE,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id),
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id)
);

-- ------------------------------ TABLE HOMEWORKS --------------------------------

CREATE TABLE Homeworks (
    homework_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    assignment_id INTEGER,
    student_id INTEGER,
    content TEXT NULL,
    grade ENUM('1', '2', '3', '4', '5') NULL,
    status ENUM('assigned', 'submitted', 'graded') DEFAULT 'assigned',
    FOREIGN KEY (assignment_id) REFERENCES Assignments(assignment_id),
    FOREIGN KEY (student_id) REFERENCES Users(user_id)
);

-- ------------------------------ TABLE PARENTHOOD --------------------------------

CREATE TABLE Parenthood (
    parenthood_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    student_id INTEGER,
    parent_id INTEGER,
    FOREIGN KEY (student_id) REFERENCES Users(user_id),
    FOREIGN KEY (parent_id) REFERENCES Users(user_id)
);

-- ------------------------------ INSERT USERS --------------------------------

INSERT INTO Users (role, first_name, middle_name, last_name, email, date_of_birth, password) VALUES
('student', 'John', 'A.', 'Doe', 'john.doe@example.com', '2005-04-15', '2bb2b31113902981978f70b74a63c70e22d9eb937caabc021fdb53666c994980'),
('student', 'Jane', NULL, 'Smith', 'jane.smith@example.com', '2006-08-22', 'ceb3fcf63daf15209023c51b11bf50e66488fa6ebe6b640b7e137482c1cf6f60'),
('student', 'Michael', 'B.', 'Johnson', 'michael.johnson@example.com', '2004-09-10', '88792189695357b5b4de17db1ea24e1f52b4a6e805b6fe737cb851ab6cb68930'),
('student', 'Emily', NULL, 'Doe', 'emily.doe@example.com', '2005-11-23', '64c7ba4f0489a37059b3911b67e99c85eefb4e459acb27c49541f6052969be0b'),
('student', 'Daniel', 'C.', 'Doe', 'daniel.doe@example.com', '2006-03-12', '4c6557f99eb64c66cca626e0c5fcb7ecbe832065d6f6c5037c3b20ba06c684a5'),
('teacher', 'Alice', 'B.', 'Johnson', 'alice.johnson@example.com', '1980-02-10', 'e6c83fe26cc461a5d29459d2848e8043bacde02c5a0b2df8fb1d1f8d283fc589'),
('teacher', 'Mark', 'C.', 'Williams', 'mark.williams@example.com', '1979-06-17', 'e2de0be6f7f6e7bd40c8c2b8679d4314a801b5ba6e2186cbf4562472a606d3f9'),
('parent', 'Robert', NULL, 'Doe', 'robert.doe@example.com', '1975-05-30', 'af94b734edc80b8808b7d0ae3e9257a4ff405139ca53e3731afd37086cb1860c'),
('parent', 'Mary', NULL, 'Smith', 'mary.smith@example.com', '1978-07-14', '03bb6876f3a8460e19afddb54807bc25767f189018749ab4f9597c0524d1d8a4'),
('admin', 'Filip', NULL, 'Kresl', 'kref01@vse.cz', '2002-06-08', '184a6b4ffbae9b8d784f2b18a30ea302a5def97c19ac624141c71abc46edb886');

-- ------------------------------ INSERT PARENTHOODS --------------------------------

INSERT INTO Parenthood (student_id, parent_id) VALUES
(1, 8),
(4, 8),
(5, 8),
(2, 9);

-- ------------------------------ INSERT COURSES --------------------------------

INSERT INTO Courses (course_name, description) VALUES
('Mathematics 1', 'Basic Mathematics Course'),
('Mathematics 2', 'Advanced Mathematics Course'),
('History', 'Basic History Course');

-- ------------------------------ INSERT COURSE TEACHERS --------------------------------

INSERT INTO CourseTeachers (teacher_id, course_id) VALUES
(6, 1),
(6, 2),
(7, 1),
(7, 3);

-- ------------------------------ INSERT ENROLLMENTS --------------------------------

INSERT INTO Enrollments (student_id, course_id) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 3),
(3, 2),
(4, 1),
(4, 2),
(5, 1);

-- ------------------------------ INSERT ASSIGNMENTS --------------------------------

INSERT INTO Assignments (course_id, teacher_id, short_description, long_description, date_assigned) VALUES
(1, 6, 'Algebra 1', 'How much is 1+1, 1+2, 1+3?', '2024-04-20'),
(1, 6, 'Algebra 2', 'How much is 2+2, 2+3, 2+4?','2024-04-25'),
(1, 6, 'Algebra 3', 'How much is 3+5, 6+10, 33+22?','2024-04-30'),
(2, 6, 'Discrete mathematics', 'Describe what a function is.', '2023-04-20'),
(2, 6, 'Combinatorics', 'How much is binomial(5,2)?', '2023-04-28'),
(1, 7, 'Linear Algebra 1', 'Define a vector', '2023-04-21'),
(1, 7, 'Linear Algebra 2', 'Define a basis', '2023-04-26'),
(3, 7, 'History essay on WW1', 'Write an essay on what led to the start of WW1. Minimum 2 words.', '2023-04-22'),
(3, 7, 'History essay on WW2', 'Write an essay on what led to the start of WW2. Minimum 2 words.', '2023-04-27'),
(3, 7, 'History essay on Cold war', 'Write an essay on why the Cold war got its name. Minimum 2 words.', '2023-04-28');

-- ------------------------------ INSERT HOMEWORKS --------------------------------

INSERT INTO Homeworks (assignment_id, student_id, content, grade, status) VALUES
(1, 1, 'Solved all algebra 1 problems.', '1', 'graded'),
(1, 4, 'Solved most of algebra 1 problems.', '2', 'graded'),
(1, 5, 'Solved some algebra 1 problems.', '3', 'graded'),
(2, 4, 'Solved all algebra 2 problems.', '1', 'graded'),
(2, 1, 'Solved few algebra 2 problems.', '4', 'graded'),
(2, 5, 'Did not solve any algebra 2 problems.', '5', 'graded'),
(3, 1, 'Solved all algebra 3 problems.', NULL, 'submitted'),
(3, 4, NULL, NULL, 'assigned'),
(3, 5, NULL, NULL, 'assigned'),
(4, 2, 'Completed Discrete mathematics assignment.', '3', 'graded'),
(4, 3, 'Worked on Discrete mathematics assignment.', '2', 'graded'),
(4, 4, 'Completed most of Discrete mathematics assignment.', '4', 'graded'),
(5, 2, 'Completed Combinatorics assignment.', '1', 'graded'),
(5, 3, 'Worked on Combinatorics assignment.', '3', 'graded'),
(5, 4, 'Completed some of Combinatorics assignment.', '5', 'graded'),
(6, 1, 'Worked on Linear Algebra 1 problems.', '2', 'graded'),
(6, 4, 'Completed Linear Algebra 1 problems.', '1', 'graded'),
(7, 5, 'Solved some Linear Algebra 2 problems.', '3', 'graded'),
(7, 2, 'Solved most of Linear Algebra 2 problems.', '2', 'graded'),
(8, 1, 'The assassination', NULL, 'submitted'),
(8, 2, 'Worked on History essay on WW1.', '3', 'graded'),
(9, 1, NULL, NULL, 'assigned'),
(9, 2, 'History essay on WW1 completed.', '4', 'graded'),
(10, 1, NULL, NULL, 'assigned'),
(10, 2, NULL, NULL, 'assigned');
