<?php

require_once '../vendor/autoload.php';

$clientID = '';
$clientSecret = '';
$redirectUri = 'https://redirectmeto.com/http://localhost/cv01/sp/Controller/oauthCallback.php';

$client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();

?>