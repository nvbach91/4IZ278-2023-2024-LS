<?php
        require __DIR__ . '/utils.php';
        $users = getEmailsAndNames('users.db');
?>
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="h3 mt-3">Registered Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
               

                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td>' . $user['name'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>