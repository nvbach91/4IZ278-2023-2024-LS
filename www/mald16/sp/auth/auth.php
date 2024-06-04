<?php
require './config.php';
require '../utils/HttpPost.php';
require '../db/User.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $url = 'https://oauth2.googleapis.com/token';

    $params = array(
        "code" => $code,
        "client_id" => $oauth2_client_id,
        "client_secret" => $oauth2_secret,
        "redirect_uri" => $oauth2_redirect,
        "grant_type" => "authorization_code"
    );

    $request = new HttpPost($url);
    $request->setPostData($params);
    $request->send();

    $responseObj = json_decode($request->getResponse());

    if (isset($responseObj->access_token)) {
        $accessToken = $responseObj->access_token;
        echo "OAuth2 server provided access token: " . $accessToken;

        $userinfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $userinfoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $userinfoResponse = curl_exec($ch);
        curl_close($ch);

        $userinfo = json_decode($userinfoResponse);

        session_start();
        if (isset($userinfo->name) && isset($userinfo->email)) {
            $User = new User($userinfo->email);
            $existingUser = $User->getUser();

            if (!$existingUser) {
                $User->addUser($userinfo->email, $userinfo->name);
            }

            $_SESSION["logged-in"] = true;
            $_SESSION["user-email"] = htmlspecialchars($userinfo->email);
            $_SESSION["user-name"] = htmlspecialchars($userinfo->name);
            $_SESSION["sm"] = 22;
            header('Location: ' . "../index.php");
            exit();
        } else {
            $_SESSION["sm"] = 23;
            header('Location: ' . "index.php");
            exit();
        }
    } else {
        $_SESSION["sm"] = 23;
        header('Location: ' . "index.php");
        exit();
    }
} else {
    $_SESSION["sm"] = 23;
    header('Location: ' . "index.php");
    exit();
}
