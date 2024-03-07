<?php
$base_dir = "/cv03";
$view_dir = "/views/";
$components_dir = "/components/";

// Get the route from the request and check if it is htmx request
$route = str_replace($base_dir, '', $_SERVER['REQUEST_URI']);
$hx_request = isset($_SERVER['HX_REQUEST']) && $_SERVER['HX_REQUEST'] == 'true';
// var_dump($_SERVER);
// Function will either generate full page or just components for htmx
register_shutdown_function(function () {
    global $content, $hx_request, $view_dir;
    if ($hx_request) {
        echo $content;
    } else {
        require __DIR__ . $view_dir . "_layout.php";
    }
});

echo $route;

// Ob start to capture output in one buffer
// Then we can decide if we want to send full page or just components
ob_start();
switch ($route) {
    case "":
    case "/":
        require __DIR__ . $view_dir . "home.php";
        break;

    case "/htmx":
        require __DIR__ . $components_dir . "fragments.php";
        break;

    default:
        http_response_code(404);
}
$content = ob_get_clean();



?>





