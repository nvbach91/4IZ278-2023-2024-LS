<?php
require_once BASE_PATH . '/classes/User.php';
require_once BASE_PATH . '/classes/Field.php';
require_once BASE_PATH . '/classes/Sport.php';
require_once BASE_PATH . '/classes/Reservation.php';
require_once BASE_PATH . '/classes/Actions.php';
require_once BASE_PATH . '/db/db.class.php';
$user = new User();
$actions = new Actions();
$reservation = new Reservation();
$sport = new Sport();
$field = new Field();
$db = new db();