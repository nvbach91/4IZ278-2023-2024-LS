<?php

$client_id = "";
$client_secret = "";

require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


function exchangeCode($data, $apiUrl) {
    $client = new Client();

    try {
        $response = $client->post($apiUrl, [
            'form_params' => $data,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        if($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        }
        return false;
    }
    catch(RequestException $e) {
        return false;
    }
}

if(isset($_GET['error']) || !isset($_GET['code'])) {
    echo 'Some error occurred';
    exit();
}

$authCode = $_GET['code'];


/**
 * let's exchange the code for an access token
 * for that we need to send a request to GitHub
 * PHP supports curl by default, by it's verbose - so let's use Guzzle
 */

$data = [
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'code' => $authCode,
];

$apiUrl = "https://github.com/login/oauth/access_token";

$tokenData = exchangeCode($data, $apiUrl);

if($tokenData === false) {
    exit('Error getting token');
}

if(!empty($tokenData->error)) {
    exit($tokenData->error);
}

if(!empty($tokenData->access_token)) {
    setcookie('cr_github_access_token', $tokenData->access_token, time() + 2592000, "/", "", false, true);
    // the last argument - true - sets it as an httponly cookie
    header('Location: github-login.php');
    exit();
}

?>