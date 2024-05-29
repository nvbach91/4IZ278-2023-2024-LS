<?php
require_once 'google-config.php';
require_once '../db/database_class.php';

$usersDB = new UsersDB();

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $token = $google_account_info->id;

  $user = $usersDB->findUser($email);
  if ($user) {
    if ($user[0]['token'] == $token) {
      setcookie("name", $email, time() + 3600, "/");
      header("Location: /www/lacp06/sp/routes/index.php");
    } else {
      array_push($errors, "Uživatel již existuje!");
    }
  } else {
    $usersDB->createUser($name, $email, $password_hash = NULL, $token);
    setcookie("name", $email, time() + 3600, "/");
    header("Location: /www/lacp06/sp/routes/index.php");
  }
}
