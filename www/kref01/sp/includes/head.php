<?php include './includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eschool</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="./profile.php">Eschool</a>
            </div>
            <ul class="menu">
                <li><a href="./assignments.php">Assignments</a></li>
                <li><a href="./evaluation.php">Evaluation</a></li>
                <li><a href="./profile.php">Profile</a></li>
                <?php if ($role === 'admin'): ?>
                    <li><a href="./users.php">Users</a></li>
                    <li><a href="./courses.php">Courses</a></li>
                    <li><a href="./adminDashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
            </ul>
            <div class="logout">
                <a href="./index.php">Sign Out</a>
            </div>
        </nav>
    </header>
</body>

</html>
