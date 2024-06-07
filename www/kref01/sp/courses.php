<?php include './includes/head.php'; ?>

<?php
require_once './classes/CoursesDB.php';
require_once './classes/EnrollmentsDB.php';
require_once './classes/CourseTeachersDB.php';


require_once './utils/CSRFToken.php';
CSRFToken::generateCSRFToken();

$coursesDB = new CoursesDB();
$enrollmentsDB = new EnrollmentsDB();
$courseTeachersDB = new CourseTeachersDB();


if ($role !== 'admin') {
    echo "<div class='container'><div class='error-banner'>You do not have permission to access this site.</div></div>";
    include './includes/foot.php';
    exit;
}

$courses = $coursesDB->getAllCourses();
?>

<?php if ($role === 'admin'): ?>
    <div class="container">
        <div class="admin-dashboard">
            <h1>Courses</h1>
            <?php foreach ($courses as $course): ?>
                <div class="assignment-card">
                    <div class="assignment-content" onclick="location.href='./course.php?id=<?php echo htmlspecialchars($course['course_id']); ?>'" style="cursor: pointer;">
                        <div class="assignment-left">
                            <div class="assignment-course"><?php echo htmlspecialchars($course['course_name']); ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php include './includes/foot.php'; ?>
