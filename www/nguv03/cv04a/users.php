<?php
require __DIR__ . '/utils/utils.php';
$usersData = readFileContent('./users.txt');
$userLines = explode(PHP_EOL, $usersData);
$users = [];
for ($i = 0; $i < count($userLines); $i++) {
    if (empty(trim($userLines[$i]))) {
        continue;
    }
    $fields = explode(';', $userLines[$i]);
    $user = [
        'name' => $fields[0],
        'email' => $fields[1],
        'phone' => $fields[2],
        'avatar' => $fields[3],
        'gender' => $fields[4],
    ];
    array_push($users, $user);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Users</h1>
    <ul class="users">
        <?php foreach($users as $user): ?>
            <li class="user" style="display: flex;">
                <div class="user-name"><?php echo $user['name']; ?></div>
                <div class="user-email"><?php echo $user['email']; ?></div>
                <div class="user-phone"><?php echo $user['phone']; ?></div>
                <div class="user-gender"><?php echo $user['gender']; ?></div>
                <button>Remove</button>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

