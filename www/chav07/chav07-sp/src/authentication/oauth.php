<?php 

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../database/UserRepository.php";
require_once __DIR__ . "/../database/OAuthRepository.php";
require_once __DIR__ . "/AuthUtils.php";



//session_start();
startSessionIfNone();
$provider = new \League\OAuth2\Client\Provider\Facebook([
    "clientId" => APP_ID,
    "clientSecret" => APP_SECRET,
    "redirectUri" => APP_REDIRECT,
    "graphApiVersion" => GRAPH_API_VERSION

]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl([
        'scope' => ['email'],
    ]);
    $_SESSION['oauth2state'] = $provider->getState();
    header("Location: ".$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    header("Location: ".BASE_URL . "/login.php");
    exit;

}

$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

// Optional: Now you have a token you can look up a users profile data
try {

    // We got an access token, let's now get the user's details
    $user = $provider->getResourceOwner($token);
    $userRepo = new UserRepository();
    $oauthRepo = new OAuthRepository();

    $localUser = $userRepo->getUserByEmail($user->getEmail());
    if($localUser == null){
        $newUser = new UserCreateDTO($user->getEmail(), $user->getName(), null, AuthRole::User);
        $userRepo->createUser($newUser);
        $localUser = $userRepo->getUserByEmail($newUser->email);
        $oauthInfo = new OAuthInfoModelCreate($localUser->id, "facebook");
        $oauthRepo->createOauthInfo($oauthInfo);
    }
    elseif($oauthRepo->getOauthInfoById($localUser->id) == null){
        $oauthInfo = new OAuthInfoModelCreate($localUser->id, "facebook");
        $oauthRepo->createOauthInfo($oauthInfo);
    }
    
    $_SESSION["user"] = $localUser;

    header("Location: ". BASE_URL . "/index.php");
    exit;

} catch (\Exception $e) {

    // Failed to get user details
    exit('Oh dear...');
}

?>