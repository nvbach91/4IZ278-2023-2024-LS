<?php 
setcookie('cnom nom nom nom', 'cookie monster', time() + 20);

//sessions
session_start();
$_SESSION['mysession'] = 'I want cookies!!';
var_dump($_SESSION);
// dosadit zboží do objektu session - git buy.php
// na produktech tlačítko s odkazem - v linku je parametr pro buy.php
// na stránce cart nehlédneme do obsahu session -> id produktů -> získá z db přes sql -> fetch -> zobrazení 
?>