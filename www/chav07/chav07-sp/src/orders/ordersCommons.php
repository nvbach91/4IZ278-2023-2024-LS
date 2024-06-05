<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../database/OrderRepository.php";
require_once __DIR__ . "/../config.php";


function ordersCommon() : int  {

    startSessionIfNone();

    if (!isAuthenticated()){
        header("HTTP/1.1 401 Unauthorized");
        header("Location: " . htmlspecialchars(BASE_URL . "/login.php"));
        exit(401);
    }

    if (!isAuthorized(AuthRole::Admin)){
        header("HTTP/1.1 403 Forbidden");
        header("Location: " . htmlspecialchars(BASE_URL . "/"));
        exit(403);
    }

    if (!isset($_GET["id"])){
        header("HTTP/1.1 404 Not Found");
        header("Location: " . htmlspecialchars(BASE_URL . "/"));
        exit(404);
    }

    $id = filter_var(htmlspecialchars( strip_tags($_GET["id"])), FILTER_SANITIZE_URL);
    return $id;
}

?>
