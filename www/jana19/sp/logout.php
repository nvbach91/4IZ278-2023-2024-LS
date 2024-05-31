<?php

require __DIR__ . '/includes/userRequired.php';

session_destroy();

header('Location: index.php');

?>