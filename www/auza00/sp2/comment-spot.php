<?php
session_start();
require 'db.php';
?>
<?php
if(isset($_SESSION['user_id'])){
    if ('POST' == $_SERVER['REQUEST_METHOD']){
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['user_username'];
        $comment_spot_id = $_POST['comment_spot_id'];
        $date = date('Y-m-d H:i:s');

        $comment = $_POST['koment'];
        $comment = stripcslashes($comment);

        $coordinatesX = $_COOKIE["longitude-for-form"];
        $coordinatesY = $_COOKIE["latitude-for-form"];
        setcookie("longitude", $coordinatesX, time() + (86400), "/");
        setcookie("latitude", $coordinatesY, time() + (86400), "/");

        $stmt = $db->prepare("INSERT INTO comments(spot_id, user_id, username, date, text) VALUES (:spot_id, :user_id, :username, :date, :text)");
        $stmt->execute([
            'spot_id' => $comment_spot_id,
            'user_id' => $user_id,
            'username' => $username,
            'date' => $date,
            'text' => $comment
        ]);
    }
    header('Location: index.php');    
}
else{
    header('Location: signup.php'); //uživatel se musí nejprve přihlásit
}
?>