<?php include './includes/head.php'; ?>

<?php
include './includes/lastVisitedCookie.php';
require_once './utils/dateFormat.php';
require_once './classes/Database.php';
require_once './classes/UsersDB.php';
require_once './classes/ParenthoodDB.php';

$usersDB = new UsersDB();
$user = $usersDB->find($user_id);
$parenthoodDB = new ParenthoodDB();

if (empty($user)) {
    echo "<div class='error-banner'>User not found!</div>";
    exit;
}

$courses = [];
$children = [];
if ($role === 'teacher') {
    $courses = $usersDB->getCoursesByTeacherId($user_id);
} else if ($role === 'student') {
    $courses = $usersDB->getCoursesByStudentId($user_id);
} else if ($role === 'parent') {
    $children = $parenthoodDB->getChildrenByParentId($user_id);
}
?>

<div class="profile-container">
    <div class="profile-header">
        <h1>Your Profile</h1>
            <?php if (!$user): ?>
                <div class="error-banner">User not found!</div>
            <?php else: ?>
        </div>
        <ul class="profile-details">
            <li>
                <label>ID:</label>
                <span><?php echo htmlspecialchars($user['user_id']); ?></span>
            </li>
            <li>
                <label>First Name:</label>
                <span><?php echo htmlspecialchars($user['first_name']); ?></span>
            </li>
            <li>
                <label>Middle Name:</label>
                <span><?php echo htmlspecialchars($user['middle_name'] ?? 'N/A'); ?></span>
            </li>
            <li>
                <label>Last Name:</label>
                <span><?php echo htmlspecialchars($user['last_name']); ?></span>
            </li>
            <li>
                <label>Email:</label>
                <span><?php echo htmlspecialchars($user['email']); ?></span>
            </li>
            <li>
                <label>Date of Birth:</label>
                <span><?php echo htmlspecialchars(DateFormat::readableDate($user['date_of_birth'])); ?></span>
            </li>
            <li>
                <label>Role:</label>
                <span><?php echo htmlspecialchars($user['role']); ?></span>
            </li>
        </ul>

        <?php if ((($role === 'student') || ($role === 'teacher')) && !empty($courses)): ?>
            <div class="profile-details">
                <h2>My Courses</h2>
                <ul>
                    <?php foreach ($courses as $course): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($course['course_name']); ?></strong>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (($role === 'parent') && !empty($children)): ?>
            <div class="profile-details">
                <h2>My Children</h2>
                <ul>
                    <?php foreach ($children as $child): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($child['first_name']) . ' ' . htmlspecialchars($child['last_name']); ?></strong>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include './includes/foot.php'; ?>
