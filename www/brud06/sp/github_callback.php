<?php
session_start();
require_once 'db/UsersDB.php';
require_once 'oauth_config.php';

if ($_GET['code']) {
    $code = $_GET['code'];
    $post = http_build_query(array(
        'client_id' => GITHUB_CLIENT_ID,
        'redirect_uri' => GITHUB_REDIRECT_URI,
        'client_secret' => GITHUB_CLIENT_SECRET,
        'code' => $code,
    ));

    $context = stream_context_create(
        array(
            "http" => array(
                "method" => "POST",
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Accept: application/json\r\n" .
                            'Content-Length: ' . strlen($post) . "\r\n",
                'content' => $post,
            )
        )
    );

    $json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
    $r = json_decode($json_data , true);
    $access_token = $r['access_token'];
    $scope = $r['scope']; 

    // Create a stream context to add HTTP headers to the request
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: PHP',
                'Authorization: token ' . $access_token
            ]
        ]
    ];
    $context = stream_context_create($opts);

    // Fetch the user data
    $user_json_data = file_get_contents('https://api.github.com/user', false, $context);
    $user_data = json_decode($user_json_data, true);
    //var_dump($user_data);

    $userDB = new UsersDB();
    $user = $userDB->findUserByGithubId($user_data['id']);
    var_dump($user);

    if ($user === null) {
        // User doesn't exist, create a new user
        $userDB->createUserWithGithub($user_data);
        $user = $userDB->findUserByGithubId($user_data['id']);
    }

    // Log the user in
    $_SESSION['name'] = $user['email'];
    $_SESSION['privilege'] = $user['privilege'];
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['isBanned'] = $user['isBanned'];
    setcookie('name', $user['email'], time() + (86400 * 30), "/");

    // Check user privilege and redirect accordingly
    if ($user['privilege'] == 2) {
        header('Location: ./admin/admin_interface.php');
    } else {
        header('Location: character_selection.php');
    }
}
?>