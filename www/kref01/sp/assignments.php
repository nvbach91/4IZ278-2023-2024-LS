<?php
include './includes/head.php';
include './includes/session.php';
include './includes/lastVisitedCookie.php';
require_once './utils/dateFormat.php';
require_once './classes/HomeworksDB.php';

$homeworksDB = new HomeworksDB();
if ($role === 'student') {
    $homeworks = $homeworksDB->getHomeworksByStudentId($user_id);
} else if ($role === 'teacher') {
    $homeworks = $homeworksDB->getHomeworksByTeacherId($user_id);
} else if ($role === 'admin') {
    $homeworks = $homeworksDB->getAllHomeworks();
}
?>

<?php if ($role === 'teacher'): ?>
    <div class="container">
        <button onclick="location.href='./newAssignment.php'" class="create-assignment-button">Create New Assignment</button>
    </div>
<?php endif; ?>

<?php if ($role === 'student'): ?>
    <div class="container">
        <h1>Pending Assignments</h1>
        <?php $pendingEmpty = true; ?>
        <?php foreach ($homeworks as $homework): ?>
            <?php if ($homework['status'] == 'assigned'): ?>
                <?php $pendingEmpty = false; ?>
                <div class="assignment-card">
                    <div class="assignment-content" onclick="location.href='./homework.php?id=<?php echo htmlspecialchars($homework['homework_id']); ?>'" style="cursor: pointer;">
                        <div class="assignment-left">
                            <div class="assignment-course"><?php echo htmlspecialchars($homework['course_name']); ?></div>
                        </div>
                        <div class="assignment-center">
                            <?php echo htmlspecialchars($homework['short_description']); ?>
                        </div>
                        <div class="assignment-right">
                            <div class="assignment-date"><?php echo htmlspecialchars(DateFormat::readableDate($homework['date_assigned'])); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($pendingEmpty === true): ?>
            <p class="no-assignments-message">There are no pending assignments.</p>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>Completed Assignments</h1>
        <?php $completedEmpty = true; ?>
        <?php foreach ($homeworks as $homework): ?>
            <?php if ($homework['status'] != 'assigned'): ?>
                <?php $completedEmpty = false; ?>
                <div class="assignment-card">
                    <div class="assignment-content" onclick="location.href='./homework.php?id=<?php echo htmlspecialchars($homework['homework_id']); ?>'" style="cursor: pointer;">
                        <div class="assignment-left">
                            <div class="assignment-course"><?php echo htmlspecialchars($homework['course_name']); ?></div>
                        </div>
                        <div class="assignment-center">
                            <?php echo htmlspecialchars($homework['short_description']); ?>
                        </div>
                        <div class="assignment-right">
                            <div class="assignment-date"><?php echo htmlspecialchars(DateFormat::readableDate($homework['date_assigned'])); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($completedEmpty === true): ?>
            <p class="no-assignments-message">There are no completed assignments.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>


<?php if (($role === 'teacher') || ($role === 'admin')): ?>
    <div class="container">
        <h1>Pending Assignments</h1>
        <?php $pendingEmpty = true; ?>
        <?php foreach ($homeworks as $homework): ?>
            <?php if ($homework['status'] == 'submitted'): ?>
                <?php $pendingEmpty = false; ?>
                <div class="assignment-card">
                    <div class="assignment-content" onclick="location.href='./homework.php?id=<?php echo htmlspecialchars($homework['homework_id']); ?>'" style="cursor: pointer;">
                        <div class="assignment-left">
                            <div class="assignment-course"><?php echo htmlspecialchars($homework['course_name']); ?></div>
                            <div class="assignment-description-teacher"><?php echo htmlspecialchars($homework['short_description']); ?></div>
                        </div>
                        <div class="assignment-center">
                            <div class="assignment-student"><?php echo htmlspecialchars($homework['first_name']) . ' ' . htmlspecialchars($homework['last_name']); ?></div>
                        </div>
                        <div class="assignment-right">
                            <div class="assignment-date"><?php echo htmlspecialchars(DateFormat::readableDate($homework['date_assigned'])); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($pendingEmpty === true): ?>
            <p class="no-assignments-message">There are no pending assignments.</p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h1>Not Submitted Assignments</h1>
        <?php $notSubmittedEmpty = true; ?>
        <?php foreach ($homeworks as $homework): ?>
            <?php if ($homework['status'] == 'assigned'): ?>
                <?php $notSubmittedEmpty = false; ?>
                <div class="assignment-card">
                    <div class="assignment-content" onclick="location.href='./homework.php?id=<?php echo htmlspecialchars($homework['homework_id']); ?>'" style="cursor: pointer;">
                        <div class="assignment-left">
                            <div class="assignment-course"><?php echo htmlspecialchars($homework['course_name']); ?></div>
                            <div class="assignment-description-teacher"><?php echo htmlspecialchars($homework['short_description']); ?></div>
                        </div>
                        <div class="assignment-center">
                            <div class="assignment-student"><?php echo htmlspecialchars($homework['first_name']) . ' ' . htmlspecialchars($homework['last_name']); ?></div>
                        </div>
                        <div class="assignment-right">
                            <div class="assignment-date"><?php echo htmlspecialchars(DateFormat::readableDate($homework['date_assigned'])); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($notSubmittedEmpty === true): ?>
            <p class="no-assignments-message">There are no not submitted assignments.</p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h1>Evaluated Assignments</h1>
        <?php $evaluatedEmpty = true; ?>
        <?php foreach ($homeworks as $homework): ?>
            <?php if ($homework['status'] == 'graded'): ?>
                <?php $evaluatedEmpty = false; ?>
                <div class="assignment-card">
                    <div class="assignment-content" onclick="location.href='./homework.php?id=<?php echo htmlspecialchars($homework['homework_id']); ?>'" style="cursor: pointer;">
                        <div class="assignment-left">
                            <div class="assignment-course"><?php echo htmlspecialchars($homework['course_name']); ?></div>
                            <div class="assignment-description-teacher"><?php echo htmlspecialchars($homework['short_description']); ?></div>
                        </div>
                        <div class="assignment-center">
                            <div class="assignment-student"><?php echo htmlspecialchars($homework['first_name']) . ' ' . htmlspecialchars($homework['last_name']); ?></div>
                        </div>
                        <div class="assignment-right">
                            <div class="assignment-date"><?php echo htmlspecialchars(DateFormat::readableDate($homework['date_assigned'])); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($evaluatedEmpty === true): ?>
            <p class="no-assignments-message">There are no evaluated assignments.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if ($role === 'parent'): ?>
    <div class="container">
        <div class="error-banner">You do not have permission to access assignments.</div>
    </div>
<?php endif; ?>

<?php include './includes/foot.php'; ?>
