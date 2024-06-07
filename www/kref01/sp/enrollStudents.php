<?php include './includes/head.php'; ?>

<?php
require_once './classes/CoursesDB.php';
require_once './classes/EnrollmentsDB.php';
require_once './classes/CourseTeachersDB.php';
require_once './classes/UsersDB.php';

require_once './utils/CSRFToken.php';
CSRFToken::generateCSRFToken();

if ($role !== 'admin') {
    echo "<div class='container'><div class='error-banner'>You do not have permission to access this site.</div></div>";
    include './includes/foot.php';
    exit;
}

$usersDB = new UsersDB();
$coursesDB = new CoursesDB();
$enrollmentsDB = new EnrollmentsDB();
$course_id = intval($_GET['id']);
$course = $coursesDB->find($course_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!CSRFToken::validateCsrfToken($_POST['csrf_token'])) {
        echo "<div class='container'><div class='error-banner'>CSRF token validation failed.</div></div>";
        include './includes/foot.php';
        exit;
    }

    $student_ids = $_POST['selected'] ?? [];
    $course_exists = $coursesDB->find($course_id);
    if (!$course_exists) {
        $errorMessages[] = "Failed assigning students: Invalid course ID.";
    } else {
        foreach ($student_ids as $student_id) {
            $student = $usersDB->find($student_id);
            $student_assigned = $enrollmentsDB->findByStudentAndCourse($student_id, $course_id);
            if ($student_assigned) {
                $errorMessages[] = "Failed assigning students: Student ($student_id) already assigned.";
            } else {
                $enrollmentsDB->create(['student_id' => $student_id, 'course_id' => $course_id]);
            }
        }
    }
}

$students = $usersDB->getAllStudentsforEnrollment($course_id);

?>

<div class="homework-container">
    <h1>Enroll students in <?php echo htmlspecialchars($course['course_name']); ?></h1>
    <?php if (isset($_SESSION['errorMessages']) && !empty($_SESSION['errorMessages'])): ?>
            <?php foreach ($_SESSION['errorMessages'] as $errorMessage): ?>
                <p class="error-banner"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errorMessages']); ?>
        <?php endif; ?>
    <?php if (!$course): ?>
        <div class="error-banner">Course not found!</div>
    <?php else: ?>
        <div class="course-container">
            <?php if (empty($students)): ?>
                <p>All students already enrolled.</p>
            <?php else: ?>
                <form method="POST" action="./enrollStudents.php?id=<?php echo htmlspecialchars($course_id); ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                    <?php foreach ($students as $student): ?>
                        <input type="checkbox" id="<?php echo htmlspecialchars($student['user_id']); ?>" name="selected[]" value="<?php echo htmlspecialchars($student['user_id']); ?>">
                        <label for="<?php echo htmlspecialchars($student['user_id']); ?>"> 
                            <?php echo htmlspecialchars($student['user_id']) . ' ' . htmlspecialchars($student['first_name']) . ' ' . htmlspecialchars($student['last_name']); ?>
                        </label>
                    <?php endforeach; ?>
                    <input class="create-assignment-button" type="submit" value="Enroll Selected Students">
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php include './includes/foot.php'; ?>
