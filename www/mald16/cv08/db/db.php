<?php

const DB_HOSTNAME = "localhost";
const DB_DATABASE = ""; // xname
const DB_USERNAME = ""; // xname
const DB_PASSWORD = ""; //heslo najdu na Esu

$db = new PDO(
    'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
