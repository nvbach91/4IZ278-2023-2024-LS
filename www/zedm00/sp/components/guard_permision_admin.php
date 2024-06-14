<?php
if (!isset($_SESSION['advertizer_id'])) {
    session_destroy();
    header("Location: admin_login.php");
}
