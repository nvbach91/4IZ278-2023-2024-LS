<?php include './includes/head.php'; ?>

<?php
require_once './classes/CoursesDB.php';
require_once './classes/UsersDB.php';
require_once './classes/EnrollmentsDB.php';
require_once './classes/CourseTeachersDB.php';
require_once './classes/ParenthoodDB.php';
require_once './classes/HomeworksDB.php';
require_once './classes/AssignmentsDB.php';

require_once './utils/CSRFToken.php';
CSRFToken::generateCSRFToken();

$coursesDB = new CoursesDB();
$usersDB = new UsersDB();
$enrollmentsDB = new EnrollmentsDB();
$courseTeachersDB = new CourseTeachersDB();
$parenthoodDB = new ParenthoodDB();
$homeworksDB = new HomeworksDB();
$assignmentsDB = new AssignmentsDB();

$errorMessages = isset($_SESSION['errorMessages']) ? $_SESSION['errorMessages'] : [];

if ($role !== 'admin') {
    echo "<div class='container'><div class='error-banner'>You do not have permission to access this site.</div></div>";
    include './includes/foot.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!CSRFToken::validateCsrfToken($_POST['csrf_token'])) {
        echo "<div class='container'><div class='error-banner'>CSRF token validation failed.</div></div>";
        include './includes/foot.php';
        exit;
    }
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_course':
                $course_name = htmlspecialchars($_POST['course_name'], ENT_QUOTES, 'UTF-8');
                if (!empty($course_name)) {
                    $coursesDB->create(['course_name' => $course_name]);
                } else {
                    $errorMessages[] = "Failed creating a course: Course name cannot be empty.";
                }
                break;
        
            case 'assign_teacher':
                $teacher_id = intval($_POST['teacher_id']);
                $course_id = intval($_POST['course_id']);
                if ($teacher_id && $course_id) {
                    $course_exists = $coursesDB->find($course_id);
                    if (!$course_exists) {
                        $errorMessages[] = "Failed assigning a teacher: Invalid course ID.";
                    } else {
                        $teacher_assigned = $courseTeachersDB->findByTeacherAndCourse($teacher_id, $course_id);
                        if ($teacher_assigned) {
                            $errorMessages[] = "Failed assigning a teacher: Teacher already assigned.";
                        } else {
                            $courseTeachersDB->create(['teacher_id' => $teacher_id, 'course_id' => $course_id]);
                        }
                    }
                } else {
                    $errorMessages[] = "Failed assigning a teacher: Teacher ID and Course ID cannot be empty.";
                }
                break;

            case 'remove_teacher':
                $teacher_id = intval($_POST['teacher_id']);
                $course_id = intval($_POST['course_id']);
                if ($teacher_id && $course_id) {
                    $teacher = $courseTeachersDB->findByTeacherAndCourse($teacher_id, $course_id);
                    if (empty($teacher)) {
                        $errorMessages[] = "Failed removing teacher from a course: Teacher not found.";
                    } else {
                        if (!$courseTeachersDB->deleteByTeacherAndCourse($teacher_id, $course_id)) {
                            $errorMessages[] = "Failed removing teacher from a course.";
                        }
                    }
                } else {
                    $errorMessages[] = "Failed removing teacher from a course: Teacher ID and Course ID cannot be empty.";
                }
                break;
        
            case 'assign_students':
                $student_ids = htmlspecialchars($_POST['student_ids'], ENT_QUOTES, 'UTF-8');
                $course_id = intval($_POST['course_id']);
                if (!empty($student_ids) && $course_id) {
                    $course_exists = $coursesDB->find($course_id);
                    if (!$course_exists) {
                        $errorMessages[] = "Failed assigning students: Invalid course ID.";
                    } else {
                        $student_ids_array = explode(',', $student_ids);
                        foreach ($student_ids_array as $student_id) {
                            $student_id = trim($student_id);
                            $student = $usersDB->find($student_id);
                            if ((empty($student)) || ($student['role'] !== 'student)')) {
                                $errorMessages[] = "Failed assigning students: Student ($student_id) not found.";
                            } else {
                                $student_assigned = $enrollmentsDB->findByStudentAndCourse($student_id, $course_id);
                                if ($student_assigned) {
                                    $errorMessages[] = "Failed assigning students: Student ($student_id) already assigned.";
                                } else {
                                    $enrollmentsDB->create(['student_id' => $student_id, 'course_id' => $course_id]);
                                }
                            }
                        }
                    }
                } else {
                    $errorMessages[] = "Failed assigning students: Student IDs and course ID cannot be empty.";
                }
                break;

            case 'remove_student':
                $student_id = intval($_POST['student_id']);
                $course_id = intval($_POST['course_id']);
                if ($student_id && $course_id) {
                    $student = $enrollmentsDB->findByStudentAndCourse($student_id, $course_id);
                    if (empty($student)) {
                        $errorMessages[] = "Failed removing student from a course: Student not found.";
                    } else {
                        if (!$enrollmentsDB->deleteByStudentAndCourse($student_id, $course_id)) {
                            $errorMessages[] = "Failed removing student from a course.";
                        }
                    }
                } else {
                    $errorMessages[] = "Failed removing student from a course: Student ID and Course ID cannot be empty.";
                }
                break;

            case 'add_parenthood':
                $parent_id = intval($_POST['parent_id']);
                $student_id = intval($_POST['student_id']);
                if ($parent_id && $student_id) {
                    if ($parenthoodDB->findByParentAndStudent($parent_id, $student_id)) {
                        $errorMessages[] = "Failed adding parenthood: Parenthood already active.";
                    } else {
                        $parenthoodDB->create(['parent_id' => $parent_id, 'student_id' => $student_id]);
                    }
                } else {
                    $errorMessages[] = "Failed adding parenthood: Parent ID and Student ID cannot be empty.";
                }
                break;

            case 'remove_parenthood':
                $parent_id = intval($_POST['parent_id']);
                $student_id = intval($_POST['student_id']);
                if ($parent_id && $student_id) {
                    if (!$parenthoodDB->deleteByParentAndStudent($parent_id, $student_id)) {
                        $errorMessages[] = "Failed removing parenthood.";
                    }
                } else {
                    $errorMessages[] = "Failed removing parenthood: Parent ID and Student ID cannot be empty.";
                }
                break;

            case 'delete_user':
                $user_id = intval($_POST['user_id']);
                if ($user_id) {
                    $user = $usersDB->find($user_id);
                    if ($user) {
                        $tmpRole = $user['role'];
                        switch ($tmpRole) {
                            case 'student':
                                $parenthoodDB->deleteByStudent($user_id);
                                $enrollmentsDB->deleteByStudent($user_id);
                                $homeworksDB->deleteByStudentId($user_id);
                                $usersDB->delete($user_id);
                                break;
                            case 'teacher':
                                $homeworksDB->deleteByTeacherId($user_id);
                                $assignmentsDB->deleteByTeacherId($user_id);
                                $courseTeachersDB->deleteByTeacherId($user_id);
                                $usersDB->delete($user_id);
                                break;
                            case 'parent':
                                $parenthoodDB->deleteByParent($user_id);
                                $usersDB->delete($user_id);
                                break;
                            case 'admin':
                                $errorMessages[] = "Failed deleting user: Cannot delete admin.";
                                break;
                        }
                    } else {
                        $errorMessages[] = "Failed deleting user: User not found.";
                    }
                } else {
                    $errorMessages[] = "Failed deleting user: User ID and Role cannot be empty.";
                }
                break;
        }
    }

    if (!empty($errorMessages)) {
        $_SESSION['errorMessages'] = $errorMessages;
    } else {
        header("Location: ./adminDashboard.php");
        exit;
    }
}

$courses = $coursesDB->getAllCourses();
$users = $usersDB->getAllUsers();
?>

<?php if ($role === 'admin'): ?>
    <div class="container">
        <div class="admin-dashboard">
            <h1>Admin Dashboard</h1>

            <?php if (isset($_SESSION['errorMessages']) && !empty($_SESSION['errorMessages'])): ?>
                <?php foreach ($_SESSION['errorMessages'] as $errorMessage): ?>
                    <p class="error-banner"><?php echo htmlspecialchars($errorMessage); ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errorMessages']); ?>
            <?php endif; ?>

            <!-- Create a Course -->
            <h2>Create a Course</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="create_course">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name" required>
                <button type="submit">Create Course</button>
            </form>

            <!-- Assign a Teacher to a Course -->
            <h2>Assign a Teacher to a Course</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="assign_teacher">
                <label for="teacher_id">Teacher:</label>
                <select id="teacher_id" name="teacher_id" required>
                    <option value="" disabled selected>Select a teacher</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'teacher'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <label for="course_id">Course:</label>
                <select id="course_id" name="course_id" required>
                    <option value="" disabled selected>Select a course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['course_id']); ?>">
                            <?php echo htmlspecialchars($course['course_id'] . ' ' . $course['course_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Assign Teacher</button>
            </form>

            <!-- Remove a Teacher from a Course -->
            <h2>Remove a Teacher from a Course</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="remove_teacher">
                <label for="teacher_id">Teacher:</label>
                <select id="teacher_id" name="teacher_id" required>
                    <option value="" disabled selected>Select a teacher</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'teacher'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <label for="course_id">Course:</label>
                <select id="course_id" name="course_id" required>
                    <option value="" disabled selected>Select a course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['course_id']); ?>">
                            <?php echo htmlspecialchars($course['course_id'] . ' ' . $course['course_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Remove Teacher</button>
            </form>

            <!-- Assign Students to a Course -->
            <h2>Assign Students to a Course</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="assign_students">
                <label for="student_ids">Student IDs (comma-separated):</label>
                <input type="text" id="student_ids" name="student_ids" pattern="^\s*\d+(\s*,\s*\d+)*\s*$" title="Enter comma-separated IDs (e.g., 1,2,3)" required>
                <label for="course_id">Course:</label>
                <select id="course_id" name="course_id" required>
                    <option value="" disabled selected>Select a course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['course_id']); ?>">
                            <?php echo htmlspecialchars($course['course_id'] . ' ' . $course['course_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Assign Students</button>
            </form>

            <!-- Remove a Student from a Course -->
            <h2>Remove a Student from a Course</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="remove_student">
                <label for="student_id">Student:</label>
                <select id="student_id" name="student_id" required>
                    <option value="" disabled selected>Select a student</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'student'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <label for="course_id">Course:</label>
                <select id="course_id" name="course_id" required>
                    <option value="" disabled selected>Select a course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['course_id']); ?>">
                            <?php echo htmlspecialchars($course['course_id'] . ' ' . $course['course_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Remove Student</button>
            </form>

            <!-- Add Parenthood -->
            <h2>Add Parenthood</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="add_parenthood">
                <label for="parent_id">Parent:</label>
                <select id="parent_id" name="parent_id" required>
                    <option value="" disabled selected>Select a parent</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'parent'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <label for="student_id">Student:</label>
                <select id="student_id" name="student_id" required>
                    <option value="" disabled selected>Select a student</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'student'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Add Parenthood</button>
            </form>

            <!-- Remove Parenthood -->
            <h2>Remove Parenthood</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="remove_parenthood">
                <label for="parent_id">Parent:</label>
                <select id="parent_id" name="parent_id" required>
                    <option value="" disabled selected>Select a parent</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'parent'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <label for="student_id">Student:</label>
                <select id="student_id" name="student_id" required>
                    <option value="" disabled selected>Select a student</option>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['role'] === 'student'): ?>
                            <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                                <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Remove Parenthood</button>
            </form>

            <!-- Delete User -->
            <h2>Delete User</h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="delete_user">
                <label for="user_id">User:</label>
                <select id="user_id" name="user_id" required>
                    <option value="" disabled selected>Select a user</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                            <?php echo htmlspecialchars($user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name']); ?> (<?php echo htmlspecialchars($user['role']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Delete User</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php include './includes/foot.php'; ?>
