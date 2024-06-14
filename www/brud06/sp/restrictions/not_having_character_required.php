<?php
if (isset($_SESSION['character_id'])) {
    header('Location: character_selection.php');
    exit;
}