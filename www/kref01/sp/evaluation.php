<?php include './includes/head.php'; ?>

<?php
include './includes/lastVisitedCookie.php';
require_once './classes/Database.php';
require_once './classes/AssignmentsDB.php';

$assignmentsDB = new AssignmentsDB();

$assignments = [];
if ($role === 'student') {
    $assignments = $assignmentsDB->getGradesByStudentId($user_id);
} else if ($role === 'parent') {
    $assignments = $assignmentsDB->getGradesByParentId($user_id);
} else if ($role === 'teacher') {
    $assignments = $assignmentsDB->getGradesByTeacherId($user_id);
} else if ($role === 'admin') {
    $assignments = $assignmentsDB->getAllGrades();
}
?>

<div class="container">
    <h1>Student Evaluations</h1>
    <?php if (empty($assignments)): ?>
        <p class="no-assignments-message">There are no evaluations yet.</p>
    <?php endif; ?>
    <?php if ($role === 'student'): ?>
        <table class="evaluation-table">
            <thead>
                <tr>
                    <th>Assignment Description</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment): ?>
                    <?php if ($assignment['status'] == 'graded'): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($assignment['short_description']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['grade']); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <?php if (($role === 'parent') || ($role === 'teacher')): ?>
        <table class="evaluation-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Submitted at</th>
                    <th>Assignment Description</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment): ?>
                    <?php if ($assignment['status'] == 'graded'): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($assignment['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['submitted_at']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['short_description']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['grade']); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <?php if ($role === 'admin'): ?>
        <table class="evaluation-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Assignment ID</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment): ?>
                    <?php if ($assignment['status'] == 'graded'): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($assignment['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['assignment_id']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['grade']); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include './includes/foot.php'; ?>
