<?php
session_start();
require __DIR__ . '/../db/UsersDB.php';
?>
<?php
$usersDB = new UsersDB();
$users = $usersDB->find();

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $username = trim($_POST['nick']);
    $username = stripcslashes($username);
    $email = $_COOKIE["oAuthEmail"]; 

    //check for used username
    $existing_username = $usersDB->checkUsedUsername($username);
    if ($existing_username != null) {
        $errors['username'] = 'Takhle se tu už někdo jmenuje';
    }

    if (empty($errors)) {
        //vlozime usera do databaze
        $usersDB->createUserOAuth(['username' => $username, 'email' => $email]);
        
        //získat údaje o userovi
        $user = $usersDB->getUserInfoByEmail($email);
    
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['user_email'] = $email;
    
        header('Location: index.php');
    }
    else{
        $_SESSION['nick-taken'] = "already-taken-yes";
        header('Location: /../index.php');
    }
}
?>