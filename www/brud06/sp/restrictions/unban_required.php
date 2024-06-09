<?php
if (isset($_SESSION['isBanned']) && $_SESSION['isBanned']) {
    echo "You have been banned and cannot play.";
    exit;
}
?>