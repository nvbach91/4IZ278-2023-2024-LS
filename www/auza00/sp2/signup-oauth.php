<?php
session_start();
require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $username = trim($_POST['nick']);
    $username = stripcslashes($username);
    $email = $_COOKIE["oAuthEmail"]; 

    //check for used username
    $stmt = $db->prepare('SELECT * FROM users WHERE username LIKE BINARY :username LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'username' => $username
    ]);
    $existing_user = @$stmt->fetchAll();

    if ($existing_user != null) {
        $errors['username'] = 'Takhle se tu už někdo jmenuje';
    }

    if (empty($errors)) {
        //vlozime usera do databaze
        $stmt = $db->prepare('INSERT INTO users(username, email) VALUES (:username, :email)');
        $stmt->execute([
            'username' => $username,
            'email' => $email
        ]);
    
        //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
        // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)
    
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $stmt->execute([
            'email' => $email
        ]);
        $user_id = @$stmt->fetchAll()[0];
    
        $_SESSION['user_id'] = $user_id['user_id'];
        $_SESSION['user_username'] = $user_id['username'];
        $_SESSION['user_email'] = $email;
    
        header('Location: index.php');
    }
    else{
        $_SESSION['nick-taken'] = "already-taken-yes";
        header('Location: index.php');
    }
}
?>