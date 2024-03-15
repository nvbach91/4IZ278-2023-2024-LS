<?php 

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

$usersData = readFileContent('../users.db');
$userLines = explode(PHP_EOL, $usersData);


$users = [];

for ($i = 0; $i < count($userLines); $i++){
    if(empty($userLines[$i])){
        continue;
    }
    $fields = explode(';', $userLines[$i]);
    if(count($fields) < 3) {
        continue;
    }
    $user = [
        'name' => $fields[0],
        'email' => $fields[1],
        'password' => $fields[2]
    ];
    array_push($users, $user);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/users.css">
    <title>Users</title>
</head>
<body>
    <h1>Registered Users</h1>
    <ul>
        <?php foreach($users as $user): ?>
            <li>
                <div class = "user-info">
                <div><h3><?php echo $user['name']; ?></h3></div>
                <div><p><?php echo $user['email']; ?></p></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>