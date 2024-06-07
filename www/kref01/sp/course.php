<?php include './includes/head.php'; ?>

<?php
require_once './classes/CoursesDB.php';
require_once './classes/EnrollmentsDB.php';
require_once './classes/CourseTeachersDB.php';

require_once './utils/CSRFToken.php';
CSRFToken::generateCSRFToken();

if ($role !== 'admin') {
    echo "<div class='container'><div class='error-banner'>You do not have permission to access this site.</div></div>";
    include './includes/foot.php';
    exit;
}

$coursesDB = new CoursesDB();
$enrollmentsDB = new EnrollmentsDB();
$courseTeachersDB = new CourseTeachersDB();
$course_id = intval($_GET['id']);
$course = $coursesDB->find($course_id);
?>

<div class="homework-container">
    <h1>Course Details</h1>
    <?php if (!$course): ?>
        <div class="error-banner">Course not found!</div>
    <?php else: ?>
        <?php
            $teachers = $courseTeachersDB->getTeachersByCourseId($course['course_id']);
            $students = $enrollmentsDB->getStudentsByCourseId($course['course_id']);
        ?>
        <div class="course-container">
            <h2><?php echo htmlspecialchars($course['course_name']); ?></h2>
            <p>Course ID: <?php echo htmlspecialchars($course['course_id']); ?></p>
            <?php if (empty($teachers)): ?>
                <p class="error-banner">No teachers assigned to this course.</p>
            <?php endif; ?>
            <?php if (empty($students)): ?>
                <p class="error-banner">No students assigned to this course.</p>
            <?php endif; ?>
            <button onclick="location.href='./enrollStudents.php?id=<?php echo htmlspecialchars($course_id); ?>'" class="enroll_students-button">Enroll Students</button>
            <table>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teachers as $teacher): ?>
                        <tr>
                            <td>Teacher</td>
                            <td><?php echo htmlspecialchars($teacher['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['last_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td>Student</td>
                            <td><?php echo htmlspecialchars($student['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include './includes/foot.php'; ?>
