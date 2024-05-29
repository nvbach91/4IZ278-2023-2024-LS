<?php
require_once '../vendor/autoload.php';

// init configuration
$clientID = '';
$clientSecret = '';
$redirectUri = 'http://localhost/www/lacp06/sp/utils/google-redirect.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
