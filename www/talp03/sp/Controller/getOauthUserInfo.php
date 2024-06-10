<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Dotenv\Dotenv;

include '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

function getUser() {
    if (empty($_COOKIE['cr_github_access_token'])) {
        return 'empty token cookie';
    }
    $apiUrl = 'https://api.github.com/user';

    $client = new Client();

    try {
        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer' . $_COOKIE['cr_github_access_token'],
                'Accept' => 'application/json',
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        }
        return 'response wasnt succesful';
    } catch(RequestException $e) {
        return $e;
    }
}

$user = false;

$user = getUser();
var_dump($user);

// if (!empty($user)) {
//     setcookie('email', htmlspecialchars($user->email), time() + 2592000, '/');
// } else {
//     header('Location: ../View/login.php');
//     exit('Something went wrong!');
// }


?>