<?php
session_start();
require __DIR__ . '/../db/CommentDB.php';
?>
<?php
$commentDB = new CommentDB();
$sent_data = null;

if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['user_username'];
        $comment_spot_id = $_POST['comment_spot_id'];

        /*// Nastavení časové zóny na Evropu/Prague
        date_default_timezone_set('Europe/Prague');

        // Získání aktuálního data a času ve formátu "den.měsíc.rok hodiny:minuty"
        $date = date('d.m.Y H:i');
        //$date = date_format($old_date, 'd. m. Y');*/

        $date = date('Y-m-d H:i:s');

        $comment = htmlspecialchars($_POST['koment']);
        /*$comment = stripcslashes($comment);*/

        $coordinatesX = $_COOKIE["longitude-for-form"];
        $coordinatesY = $_COOKIE["latitude-for-form"];
        setcookie("longitude", $coordinatesX, time() + (86400), "/");
        setcookie("latitude", $coordinatesY, time() + (86400), "/");


        //vlozime komentář do databaze
        $commentDB->commentSpot(['spot_id' => $comment_spot_id, 'user_id' => $user_id, 'username' => $username, 'date' => $date, 'text' => $comment]);
        $comment_id_from_db = $commentDB->getComment(['spot_id' => $comment_spot_id, 'user_id' => $user_id, 'date' => $date]);

        //$comment_id_decoded = json_decode($comment_id_from_db, true);
        //$comment_id = $comment_id_decoded['comment_id'];

        $sent_data = array($comment_spot_id, $user_id, $username, $date, $comment, $comment_id_from_db);
        echo json_encode($sent_data);

} else {
    echo('SignInFirst');
    //header('Location: /../user/SignUp.php'); //uživatel se musí nejprve přihlásit
}
?>