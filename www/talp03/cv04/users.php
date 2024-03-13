<?php 

require __DIR__ . '/utils.php';

$userData = readFileContent('./users.text');
$userLines = explode(PHP_EOL, $userData);
$users = [];

for ($i = 0; $i < count($userLines); $i++) {
    if (empty(trim($userLines[$i]))) {
        continue;
    }
    $fields = explode(';', $userLines[$i]);
    $user = [
        'name' => $fields[0],
        'email' => $fields[1],
        'password' => $fields[2],
        'phone' => $fields[3],
        'avatar' => $fields[4],
        'gender' => $fields[5],
        'deck' => $fields[6],
        'cards' => $fields[7],
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
    <link rel="stylesheet" href="./css/users.css">
</head>
<body>
    <h1>Competitors</h1>
    <div class="list-wrapper">
        <ul class="list-users">
            <?php foreach($users as $user): ?>
                <li class="user-bracket">
                    <div class="user-name"><?php echo $user['name']; ?></div>
                    <div class="user-email"><?php echo $user['email']; ?></div>
                    <div class="user-phone"><?php echo $user['phone']; ?></div>
                    <div class="user-gender"><?php echo $user['gender']; ?></div>
                    <div class="user-deck"><?php echo $user['deck']; ?></div>
                    <div class="user-cards"><?php echo $user['cards']; ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div>
        <p><a class="button" href="./home.php">Logout</a></p>
    </div>
</body>
</html>