<?php
if (!isset($_SESSION['customer_id'])) {
    session_destroy();
    header("Location: index.php");
}
?>
