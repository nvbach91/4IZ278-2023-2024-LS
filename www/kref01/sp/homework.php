<?php include './includes/head.php'; ?>

<?php
require_once './utils/dateFormat.php';
require_once './utils/CSRFToken.php';
require_once './classes/HomeworksDB.php';
require_once './classes/UsersDB.php';

CSRFToken::generateCSRFToken();

if (!isset($_GET['id'])) {
    echo "<div class='error-banner'>No homework identifier provided!</div>";
    exit;
}

$homework_id = intval($_GET['id']);
$homeworksDB = new HomeworksDB();
$homework = null;
$error_message = null;
if ($role === 'student') {
    $homework = $homeworksDB->getHomeworkByHomeworkIdAndStudentId($homework_id, $user_id);
} else if ($role === 'teacher') {
    $homework = $homeworksDB->getHomeworkByHomeworkIdAndTeacherId($homework_id, $user_id);
} else if ($role === 'admin') {
    $homework = $homeworksDB->getHomeworkByHomeworkId($homework_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'submit_homework') {
        if (!CSRFToken::validateCsrfToken($_POST['csrf_token'])) {
            echo "<div class='container'><div class='error-banner'>CSRF token validation failed.</div></div>";
            include './includes/foot.php';
            exit;
        }
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
        if (empty($content)) {
            $error_message = "You cannot submit empty homework.";
        } else {
            $submitted_at = date('Y-m-d H:i:s');
            $homeworksDB->updateHomeworkContent($homework_id, $user_id, $content, $submitted_at);
            header("Location: ./assignments.php");
            exit;
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'evaluate_homework') {
        $grade = intval($_POST['grade']);
        $student_id = $homework['student_id'];
        $homeworksDB->updateHomeworkGrade($homework_id, $student_id, $grade);

        $usersDB = new UsersDB();
        $student = $usersDB->find($student_id);
        $teacher = $usersDB->find($user_id);

        if ($student) {
            $to = htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8');
            $subject = 'Your homework has been evaluated';
            $message = '
                <html>
                <head>
                    <title>Your homework has been evaluated</title>
                </head>
                <body>
                    <h1>Your homework in course <strong>' . htmlspecialchars($homework['course_name'], ENT_QUOTES, 'UTF-8') . '</strong>
                        with description <strong>' . htmlspecialchars($homework['short_description'], ENT_QUOTES, 'UTF-8') . '</strong>
                        has been evaluated with grade: ' . htmlspecialchars($grade, ENT_QUOTES, 'UTF-8') . '.</h1>
                    <p>Evaluated by ' . htmlspecialchars($teacher['first_name'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($teacher['last_name'], ENT_QUOTES, 'UTF-8') . '</p>
                </body>
                </html>
            ';
            $headers = "MIME-Version: 1.0" . "\r\n" . 
                        "Content-type:text/html;charset=UTF-8" . "\r\n" . 
                        'From: kref01@vse.cz' . "\r\n" .
                        'Reply-To: kref01@vse.cz' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        }
        
        header("Location: ./assignments.php");
        exit;
    }
}
?>

<div class="homework-container">
    <h1>Assignment Details</h1>
    <?php if (!$homework): ?>
        <div class="error-banner">Homework not found!</div>
    <?php else: ?>
        <?php if (isset($error_message)): ?>
            <p class="error-banner"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <div class="homework-detail">
            <div class="homework-header">
                <div class="homework-course"><?php echo htmlspecialchars($homework['course_name']); ?></div>
                <div class="homework-short-description"><?php echo htmlspecialchars($homework['short_description']); ?></div>
                <div class="homework-date"><?php echo htmlspecialchars(DateFormat::readableDate($homework['date_assigned'])); ?></div>
            </div>
            <div class="homework-status">
                <strong>Status:</strong> <?php echo htmlspecialchars($homework['status']); ?>
            </div>
            <div class="homework-grade">
                <?php if (empty($homework['submitted_at'])): ?>
                    <strong>Submitted at:</strong> <?php echo htmlspecialchars("N/A"); ?>
                    <?php else: ?>
                        <strong>Submitted at:</strong> <?php echo htmlspecialchars(DateFormat::readableDateTime($homework['submitted_at'])); ?>
                <?php endif; ?>
            </div>
            <div class="homework-grade">
                <strong>Grade:</strong> <?php echo htmlspecialchars($homework['grade'] ?? 'N/A'); ?>
            </div>
            <div class="homework-long-description">
                <strong>Description:</strong> <?php echo htmlspecialchars($homework['long_description']); ?>
            </div>
        </div>

        <?php if (($role === 'student') && ($homework['status'] == 'assigned')): ?>
            <h2>Submit Your Homework</h2>
            <form method="POST" class="homework-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="submit_homework">
                <textarea name="content" rows="10" placeholder="Write your homework here..."><?php echo htmlspecialchars($homework['content'] ?? ''); ?></textarea><br>
                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <h2>Submitted Content</h2>
            <div class="homework-submitted-content">
                <?php echo nl2br(htmlspecialchars($homework['content'] ?? 'No content submitted yet.')); ?>
            </div>
        <?php endif; ?>

        <?php if ($role === 'teacher' && $homework['status'] == 'submitted'): ?>
            <h2>Evaluate Homework</h2>
            <form method="POST" class="homework-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CSRFToken::getCsrfToken()); ?>">
                <input type="hidden" name="action" value="evaluate_homework">
                <label for="grade">Grade:</label><br>
                <label><input type="radio" name="grade" value="1" <?php if ($homework['grade'] == '1') echo 'checked'; ?>> 1</label>
                <label><input type="radio" name="grade" value="2" <?php if ($homework['grade'] == '2') echo 'checked'; ?>> 2</label>
                <label><input type="radio" name="grade" value="3" <?php if ($homework['grade'] == '3') echo 'checked'; ?>> 3</label>
                <label><input type="radio" name="grade" value="4" <?php if ($homework['grade'] == '4') echo 'checked'; ?>> 4</label>
                <label><input type="radio" name="grade" value="5" <?php if ($homework['grade'] == '5') echo 'checked'; ?>> 5</label><br>
                <button type="submit">Submit Evaluation</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include './includes/foot.php'; ?>
