<?php
session_start();
require_once __DIR__ . '../../config.php';

if (isset($_SESSION['admin'])) {
    include BASE_PATH . '/includes/authAdmin.php';
} else {
    include BASE_PATH . '/includes/auth.php';
}
$user_date_string = htmlspecialchars($_GET["date"]);
$monday = new DateTime('monday this week');
$sunday_next_next_week = clone $monday;
$sunday_next_next_week->modify('+20 days');
$user_date = new DateTime($user_date_string);
$today = new DateTime(date("Y-m-d"));
include BASE_PATH . '/includes/reservation/reservation.class.php';
$reservation = new reservation();

if ($user_date <= $sunday_next_next_week && $user_date >= $monday) {
    $reservation->getCalendar($user_date_string);
} else if ($user_date >= $monday && isset($_SESSION['admin'])) {
    $reservation->getCalendar($user_date_string);
}
