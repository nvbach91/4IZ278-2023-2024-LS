<?php

require_once 'oauthController.php';
require_once '../Model/UserDB.php';

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  $google_oauth = new Google\Service\Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $token = $google_account_info->id;

  $userData = [
        'name' => $name, 
        'email' => $email,
        'password' => NULL
    ];
  $userDB = new UserDB();
  $user = $userDB->findUserByEmail($email);
  $errors = [];

  if ($user) {
    if ($user[0]['email'] == $userData['email']) {
      setcookie("email", $email, time() + 26600, "/cv01/sp/");
      header("Location: ../View/index.php");
      exit();
    } else {
      array_push($errors, "Uživatel již existuje!");
      header("Location: ../View/login.php");
      exit();
    }
  } else {
    $userDB->registerUser($userData);
    setcookie("email", $email, time() + 26600, "/cv01/sp/");
    header("Location: ../View/index.php");
    exit();
  }
}

?>