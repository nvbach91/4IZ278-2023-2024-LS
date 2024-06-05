<?php
$last_visited_page = $_SERVER['REQUEST_URI'];
setcookie('last_visited', $last_visited_page, time() + (86400 * 30), "/");
?>