<?php

// DEVELOPMENT

// const DB_HOSTNAME = "localhost";
// const DB_DATABASE = "mald16-sp"; // xname
// const DB_USERNAME = "root"; // xname
// const DB_PASSWORD = ""; //heslo najdu na Esu

// PRODUKCE

// const DB_HOSTNAME = "localhost";
// const DB_DATABASE = "mald16"; // xname
// const DB_USERNAME = "mald16"; // xname
// const DB_PASSWORD = ""; //heslo najdu na Esu

$db = new PDO(
    'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
