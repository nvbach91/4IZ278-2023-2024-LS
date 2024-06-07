-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2024 at 02:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Eschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assignments`
--

CREATE TABLE `Assignments` (
  `assignment_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `date_assigned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Assignments`
--

INSERT INTO `Assignments` (`assignment_id`, `course_id`, `teacher_id`, `short_description`, `long_description`, `date_assigned`) VALUES
(1, 1, 6, 'Algebra 1', 'How much is 1+1, 1+2, 1+3?', '2024-05-20'),
(2, 1, 6, 'Algebra 2', 'How much is 2+2, 2+3, 2+4?', '2024-05-25'),
(3, 1, 6, 'Algebra 3', 'How much is 3+5, 6+10, 33+22?', '2024-05-30'),
(4, 2, 6, 'Discrete mathematics', 'Describe what a function is.', '2024-06-01'),
(5, 2, 6, 'Combinatorics', 'How much is binomial(5,2)?', '2024-06-04'),
(6, 1, 7, 'Linear Algebra 1', 'Define a vector', '2024-05-21'),
(7, 1, 7, 'Linear Algebra 2', 'Define a basis', '2024-05-29'),
(8, 3, 7, 'History essay on WW1', 'Write an essay on what led to the start of WW1. Minimum 2 words.', '2024-05-22'),
(9, 3, 7, 'History essay on WW2', 'Write an essay on what led to the start of WW2. Minimum 2 words.', '2024-05-27'),
(10, 3, 7, 'History essay on Cold war', 'Write an essay on how the Cold war got its name. Minimum 2 words.', '2024-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE `Courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`course_id`, `course_name`, `description`) VALUES
(1, 'Mathematics 1', 'Basic Mathematics Course'),
(2, 'Mathematics 2', 'Advanced Mathematics Course'),
(3, 'History', 'Basic History Course');

-- --------------------------------------------------------

--
-- Table structure for table `CourseTeachers`
--

CREATE TABLE `CourseTeachers` (
  `course_teacher_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CourseTeachers`
--

INSERT INTO `CourseTeachers` (`course_teacher_id`, `teacher_id`, `course_id`) VALUES
(1, 6, 1),
(2, 6, 2),
(3, 7, 1),
(4, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Enrollments`
--

CREATE TABLE `Enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Enrollments`
--

INSERT INTO `Enrollments` (`enrollment_id`, `student_id`, `course_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 2, 3),
(5, 3, 2),
(6, 4, 1),
(7, 4, 2),
(8, 5, 1),
(9, 2, 1),
(10, 3, 1),
(11, 3, 3),
(12, 4, 3),
(13, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Homeworks`
--

CREATE TABLE `Homeworks` (
  `homework_id` int(11) NOT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `grade` enum('1','2','3','4','5') DEFAULT NULL,
  `status` enum('assigned','submitted','graded') DEFAULT 'assigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Homeworks`
--

INSERT INTO `Homeworks` (`homework_id`, `assignment_id`, `student_id`, `content`, `submitted_at`, `grade`, `status`) VALUES
(1, 1, 1, 'Solved all algebra 1 problems.', '2024-05-25 10:20:30', '1', 'graded'),
(2, 1, 4, 'Solved most of algebra 1 problems.', '2024-05-26 11:30:45', '2', 'graded'),
(3, 1, 5, 'Solved some algebra 1 problems.', '2024-05-27 09:15:00', '3', 'graded'),
(4, 2, 4, 'Solved all algebra 2 problems.', '2024-05-28 08:45:30', '1', 'graded'),
(5, 2, 1, 'Solved few algebra 2 problems.', '2024-05-29 14:20:15', '4', 'graded'),
(6, 2, 5, 'Did not solve any algebra 2 problems.', '2024-05-31 16:10:05', '5', 'graded'),
(7, 3, 1, 'Solved all algebra 3 problems.', '2024-05-31 18:00:00', NULL, 'submitted'),
(8, 3, 4, NULL, NULL, NULL, 'assigned'),
(9, 3, 5, NULL, NULL, NULL, 'assigned'),
(10, 4, 2, 'Completed Discrete mathematics assignment.', '2024-06-02 13:25:30', '3', 'graded'),
(11, 4, 3, 'Worked on Discrete mathematics assignment.', '2024-06-03 17:40:20', '2', 'graded'),
(12, 4, 4, 'Completed most of Discrete mathematics assignment.', '2024-06-04 08:55:45', '4', 'graded'),
(13, 5, 2, 'Completed Combinatorics assignment.', '2024-06-05 09:10:50', '1', 'graded'),
(14, 5, 3, 'Worked on Combinatorics assignment.', '2024-06-05 10:20:25', '3', 'graded'),
(15, 5, 4, 'Completed some of Combinatorics assignment.', '2024-06-05 08:45:15', '2', 'graded'),
(16, 6, 1, 'Worked on Linear Algebra 1 problems.', '2024-05-25 17:30:00', '2', 'graded'),
(17, 6, 4, 'Completed Linear Algebra 1 problems.', '2024-05-26 18:40:10', '1', 'graded'),
(18, 7, 5, 'Solved some Linear Algebra 2 problems.', '2024-05-30 20:50:30', '3', 'graded'),
(19, 7, 2, 'Solved most of Linear Algebra 2 problems.', '2024-05-31 21:10:45', '2', 'graded'),
(20, 8, 1, 'The assassination', '2024-05-24 22:20:00', NULL, 'submitted'),
(21, 8, 2, 'Worked on History essay on WW1.', '2024-05-26 23:30:25', NULL, 'submitted'),
(22, 9, 1, NULL, NULL, NULL, 'assigned'),
(23, 9, 2, 'History essay on WW1 completed.', '2024-05-31 09:40:35', NULL, 'submitted'),
(24, 10, 1, NULL, NULL, NULL, 'assigned'),
(25, 10, 2, NULL, NULL, NULL, 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `Parenthood`
--

CREATE TABLE `Parenthood` (
  `parenthood_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Parenthood`
--

INSERT INTO `Parenthood` (`parenthood_id`, `student_id`, `parent_id`) VALUES
(1, 1, 8),
(2, 4, 8),
(3, 5, 8),
(4, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `role` enum('student','teacher','parent','admin') DEFAULT 'student',
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `role`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `date_of_birth`) VALUES
(1, 'student', 'John', 'A.', 'Doe', 'john.doe@example.com', '2bb2b31113902981978f70b74a63c70e22d9eb937caabc021fdb53666c994980', '2005-04-15'),
(2, 'student', 'Jane', NULL, 'Smith', 'jane.smith@example.com', 'ceb3fcf63daf15209023c51b11bf50e66488fa6ebe6b640b7e137482c1cf6f60', '2006-08-22'),
(3, 'student', 'Michael', 'B.', 'Johnson', 'michael.johnson@example.com', '88792189695357b5b4de17db1ea24e1f52b4a6e805b6fe737cb851ab6cb68930', '2004-09-10'),
(4, 'student', 'Emily', NULL, 'Doe', 'emily.doe@example.com', '64c7ba4f0489a37059b3911b67e99c85eefb4e459acb27c49541f6052969be0b', '2005-11-23'),
(5, 'student', 'Daniel', 'C.', 'Doe', 'daniel.doe@example.com', '4c6557f99eb64c66cca626e0c5fcb7ecbe832065d6f6c5037c3b20ba06c684a5', '2006-03-12'),
(6, 'teacher', 'Alice', 'B.', 'Johnson', 'alice.johnson@example.com', 'e6c83fe26cc461a5d29459d2848e8043bacde02c5a0b2df8fb1d1f8d283fc589', '1980-02-10'),
(7, 'teacher', 'Mark', 'C.', 'Williams', 'mark.williams@example.com', 'e2de0be6f7f6e7bd40c8c2b8679d4314a801b5ba6e2186cbf4562472a606d3f9', '1979-06-17'),
(8, 'parent', 'Robert', NULL, 'Doe', 'robert.doe@example.com', 'af94b734edc80b8808b7d0ae3e9257a4ff405139ca53e3731afd37086cb1860c', '1975-05-30'),
(9, 'parent', 'Mary', NULL, 'Smith', 'mary.smith@example.com', '03bb6876f3a8460e19afddb54807bc25767f189018749ab4f9597c0524d1d8a4', '1978-07-14'),
(10, 'admin', 'Filip', NULL, 'Kresl', 'kref01@vse.cz', '184a6b4ffbae9b8d784f2b18a30ea302a5def97c19ac624141c71abc46edb886', '2002-06-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assignments`
--
ALTER TABLE `Assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `CourseTeachers`
--
ALTER TABLE `CourseTeachers`
  ADD PRIMARY KEY (`course_teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `Enrollments`
--
ALTER TABLE `Enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `Homeworks`
--
ALTER TABLE `Homeworks`
  ADD PRIMARY KEY (`homework_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `Parenthood`
--
ALTER TABLE `Parenthood`
  ADD PRIMARY KEY (`parenthood_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Assignments`
--
ALTER TABLE `Assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Courses`
--
ALTER TABLE `Courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `CourseTeachers`
--
ALTER TABLE `CourseTeachers`
  MODIFY `course_teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Enrollments`
--
ALTER TABLE `Enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Homeworks`
--
ALTER TABLE `Homeworks`
  MODIFY `homework_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `Parenthood`
--
ALTER TABLE `Parenthood`
  MODIFY `parenthood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assignments`
--
ALTER TABLE `Assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `CourseTeachers`
--
ALTER TABLE `CourseTeachers`
  ADD CONSTRAINT `courseteachers_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `courseteachers_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`);

--
-- Constraints for table `Enrollments`
--
ALTER TABLE `Enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`);

--
-- Constraints for table `Homeworks`
--
ALTER TABLE `Homeworks`
  ADD CONSTRAINT `homeworks_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `Assignments` (`assignment_id`),
  ADD CONSTRAINT `homeworks_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Parenthood`
--
ALTER TABLE `Parenthood`
  ADD CONSTRAINT `parenthood_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `parenthood_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `Users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
