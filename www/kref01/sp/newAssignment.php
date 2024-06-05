<?php
include './includes/head.php';
include './includes/session.php';
require_once './utils/CSRFToken.php';
require_once './classes/AssignmentsDB.php';
require_once './classes/UsersDB.php';
require_once './classes/CoursesDB.php';

function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
CSRFToken::generateCSRFToken();

if ($role !== 'teacher' && $role !== 'admin') {
    echo "<div class='error-banner'>You do not have permission to create assignments!</div>";
    exit;
}

$assignmentsDB = new AssignmentsDB();
$coursesDB = new CoursesDB();
$courses = $coursesDB->getCoursesByTeacherId($user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'course_id' => intval($_POST['course_id']),
        'teacher_id' => $user_id,
        'short_description' => htmlspecialchars($_POST['short_description'], ENT_QUOTES, 'UTF-8'),
        'long_description' => htmlspecialchars($_POST['long_description'], ENT_QUOTES, 'UTF-8'),
        'date_assigned' => date('Y-m-d')
    ];


    if ($data['course_id'] > 0 && !empty($data['short_description']) && !empty($data['long_description'])) {
        $assignment_id = $assignmentsDB->create($data);
        if ($assignment_id) {
            $studentsDB = new UsersDB();
            $students = $studentsDB->getStudentsByCourseId($data['course_id']);
            foreach ($students as $student) {
                $assignmentsDB->createHomework($assignment_id, $student['user_id']);
            }
            $success_message = "Assignment created successfully.";
        } else {
            $error_message = "Failed to create assignment.";
        }
    } else {
        $error_message = "All fields are required.";
    }
}
?>

<div class="container">
    <h1>Create New Assignment</h1>
    <?php if (isset($success_message)): ?>
        <p class="success-banner"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <p class="error-banner"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    <div class="form-container">
        <form method="POST" action="newAssignment.php">
            <div class="form-group">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <label for="course_id">Course:</label>
                <select id="course_id" name="course_id" required>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['course_id']); ?>"><?php echo htmlspecialchars($course['course_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description:</label>
                <input type="text" id="short_description" name="short_description" required>
            </div>
            <div class="form-group">
                <label for="long_description">Long Description:</label>
                <textarea id="long_description" name="long_description" rows="5" required></textarea>
            </div>
            <button type="submit" class="create-assignment-button">Create Assignment</button>
        </form>
    </div>
</div>

<?php include './includes/foot.php'; ?>
