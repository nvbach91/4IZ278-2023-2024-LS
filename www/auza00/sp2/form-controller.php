<?php
session_start();
require 'db.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if ($_POST == 'add-spot') {
        //process form1
        var_dump('success');
    } else if ($_POST == 'add-comment') {
        //process form2
    }
}
?>