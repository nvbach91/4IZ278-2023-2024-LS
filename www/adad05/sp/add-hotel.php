<?php

require __DIR__ . '/classes/HotelsDB.php';
$hotelsDB = new HotelsDB();

if(isset($_POST)){
    $hotelsDB->createHotel($_POST['name'], $_POST['address']);
    Header ('Location: administration-page.php?edit-mode=hotels');
}

?>