<?php
const DB_HOST = 'md405.wedos.net';
const DB_DATABASE = 'd341941_spot';
const DB_USERNAME = 'a341941_spot';
const DB_PASSWORD = 'rcMcSkEs';

//pripojeni do db na serveru eso.vse.cz
// nenahravat username a password, ani dbname na git!
$db = new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);
//vyhazuje vyjimky v pripade neplatneho SQL vyrazu
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);