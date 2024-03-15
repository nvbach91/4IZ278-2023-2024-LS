<?php

require '../components/utils.php';
$userData = readFileContent('../users.txt');
$userLines = explode("\n", $userData);
$users = [];

for ($i = 0; $i < count($userLines); $i++) {
    if (!$userLines[$i] == '') {
        $fields = explode(';', $userLines[$i]);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1]
        ];
        array_push($users, $user);
    }
}

?>

<div class="wrapper">
    <h1>List of all registered users:</h1>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li>
                <div><?php echo $user['name'] ?>, <?php echo $user['email'] ?></div>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="go-back">
        <a href="../">Go back to main page!</a>
    </div>
</div>