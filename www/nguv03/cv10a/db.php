<?php

$pdo =  new PDO(
    'mysql:host=localhost;dbname=nguv03',
    'root',
    ''
);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function findUser($pdo, $email) {
    $statement = $pdo->prepare("
        SELECT * FROM cv10_users WHERE email = :email;
    ");
    $statement->execute([ 'email' => $email ]);
    return $statement->fetchAll()[0];
}

// var_dump($pdo);


?>