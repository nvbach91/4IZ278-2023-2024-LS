<?php
session_start();
?>
<?php
if ($_SESSION['user_privilege'] != 1) {
    header('Location: /../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang='cs'>

<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='/../css/style.css'>
    <title>Admin</title>

    <meta name="description" content="Stránka pro admina">
    <meta name="keywords" content="i know a spot, mapa, spot, joint, špek, bong, tráva, marihuana, místo">
    <meta name="author" content="Adam Auzký">

    <link rel='icon' type='image/x-icon' href='img/cannabis-solid.png'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link
        href='https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'
        rel='stylesheet'>

    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
    <link rel='stylesheet' href='https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.css' />
    <script src='https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.js'></script>

    <script src='https://kit.fontawesome.com/d7179d63a4.js' crossorigin='anonymous'></script>
    <meta http-equiv='Content-Security-Policy' content='upgrade-insecure-requests'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body id="admin_body">
    <h2 style="text-align: center; margin-top: 30px">Welcome to admin page</h2>
    <p id="spots-numberA"></p>
    <div id="spots-listA">

    </div>

    <script src='/../js/admin_spots.js'></script>
</body>

</html>