<?php

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

include '../vendor/autoload.php';

function exchangeCode($data, $apiUrl) {
    $client = new Client();
    try {
        $response = $client->post($apiUrl, [
            'form_params' => $data,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        }
        return false;
    }
    catch(RequestException $e) {
        return false;
    }
}

if (isset($_GET['error']) || !isset($_GET['code'])) {
    echo 'Some error occured';
    exit();
}

$authCode = $_GET['code'];
var_dump($authCode);

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

$data = [
    'client_id' => $_ENV['CLIENT_ID'],
    'client_secret' => $_ENV['CLIENT_SECRET'],
    'code' => $authCode,
];

$apiUrl = 'https://github.com/login/oauth/access_token';

$tokenData = exchangeCode($data, $apiUrl);

if ($tokenData === false) {
    exit('Error getting token');
}

if (!empty($tokenData->error)) {
    exit($tokenData->error);
}

var_dump($tokenData);
var_dump($tokenData->access_token);


$client = new Client();

$response = $client->get("https://api.github.com/user", [
    'headers' => [
        'Authorization' => $tokenData->access_token,
    ]
]);
var_dump($response);
function getUser() {
    // if (empty($_COOKIE['cr_github_access_token'])) {
    //     return 'empty token cookie';
    // }
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

// $client = new Client();

// $response = $client->post('https://api.github.com/applications', [
//     'form_params' => [
//         'client_id' => $_ENV['CLIENT_ID'],
//         'access_token' => $tokenData->access_token,
//     ],
//     'header' => [
//         'Accept' => 'application/json'
//     ]
// ]);
// $status = $response->getStatusCode();
// var_dump($status);

// if (!empty($tokenData->access_token)) {
//     setcookie('cr_github_access_token', $tokenData->access_token, time() + 2592000, '/', null, false, true);
//     header('Location: http://localhost/cv01/sp/Controller/getOauthUserInfo.php');
//     exit();
// }

?>