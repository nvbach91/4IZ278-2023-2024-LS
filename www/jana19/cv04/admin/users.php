<?php

require __DIR__ . '/../utils.php';

$usersData = readFileContent('./users.db');
$userLines = explode(PHP_EOL, $usersData);

$users = []; 
for ($i = 0; $i < count ($userLines); $i++) {
    if (empty(trim($userLines[$i]))) {
        continue;
    }
    $fields = explode(';', $userLines[$i]);
    $user = [
        'name' => $fileds[0],
        'email' => $fileds[1],
        'phone' => $fileds[2],
        'avatar' => $fileds[3],
        'gender' => $fileds[4],
        'cardDeck' => $fields[5],
        'cardAmmount' => $fields[6],
        'password' => $fields[7]
    ];
    array_push($users, $user);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cv04</title>
</head>

<body>
    <h1>Users</h1>
    <ul>
        <?php foreach($users as $user): ?>
            <li class="user">
                <div class="user-name"><?php echo $user['name']; ?></div>
                <div class="user-email"><?php echo $user['email']; ?></div>
                <div class="user-phone"><?php echo $user['phone']; ?></div>
                <div class="user-avatar"><?php echo $user['avatar']; ?></div>
                <div class="user-gender"><?php echo $user['gender']; ?></div>
                <div class="user-card-deck"><?php echo $user['cardDeck']; ?></div>
                <div class="user-card-ammount"><?php echo $user['cardAmmount']; ?></div>
                <div class="password"><?php echo $user['password']; ?></div>
                <button>Remove</button>
            </li>
        <?php endforeach ?>
    </ul>
</body>
</html>