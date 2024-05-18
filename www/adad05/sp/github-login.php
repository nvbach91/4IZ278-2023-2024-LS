<?php

require __DIR__ . '/classes/UsersDB.php';
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function getUser($apiUrl) {
    if(empty($_COOKIE['cr_github_access_token'])) {
        return false;
    }

    $client = new Client();

    try {
        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $_COOKIE['cr_github_access_token'],
                'Accept' => 'application/json',
            ]
        ]);

        if($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
        return false;
    }
    catch(RequestException $e) {
        return false;
    }
}

$emails = getUser('https://api.github.com/user/emails');
$user_email;
foreach($emails as $email) {
    if($email['primary']){
        $user_email = $email['email'];
    }
}

var_dump($user_email);
$usersDB = new UsersDB();
$user = $usersDB->findByEmail($user_email);
if(!empty($user)) {
    setcookie("email", $user[0]['email'], time() + 60 * 60);
    setcookie("user_id", $user[0]['user_id'], time() + 60 * 60);
    setcookie("privilege", $user[0]['privilege'], time() + 60 * 60);
    header("Location: reservation-page.php");
    exit;
} else {
    header("Location: registration-page.php");
    exit;
}



?>