<?php

include_once '../controller/OffersDB.php';
include_once '../controller/TagsDB.php';
include_once '../controller/AgenciesDB.php';
include_once '../controller/homeCustomersDB.php';
include_once '../controller/CustomersDB.php';
if(empty($_GET['id'])) {
	header('Location: main.php');
}
$id = (int) $_GET['id'];
const offersdb = new OffersDB();
$offers = offersdb->read($id);
$offer = $offers[0];
const tagsdb = new TagsDB();
$tags = tagsdb->readAll();
const agenciesDB = new AgenciesDB();
$agencies = agenciesDB->readAll();
const homeCustomersDB = new homeCustomersDB();
$homeCustomers = homeCustomersDB->readAll();
const customersDB = new CustomersDB();
$customers = customersDB->readAll();

$email =  $_COOKIE['email'];
$customer = null;
foreach ($customers as $c) {
if($c['email'] == $email) {
    $customer = $c;
  }
}

foreach ($offers as &$offer) {
    $splitPrice = strrev(chunk_split(strrev($offer['price']), 3, ' '));
    if ($offer['offerType'] == 'rent') {
        $offer['priceString'] = 'Nájem za ' . $splitPrice . ',- kč';
    } else if ($offer['offerType'] == 'buy') {
        $offer['priceString'] = 'Koupě za ' . $splitPrice . ',- kč';
    } else {
        $offer['priceString'] = $splitPrice . ',- kč';
    }

    if ($offer['homeType'] == 'apartment') {
        $offer['typeString'] = 'Byt';
    } else if ($offer['homeType'] == 'house') {
        $offer['typeString'] = 'Dům';
    } else {
        $offer['typeString'] = '';
    }
    $dateTime = new DateTime($offer['time_offered']);

    $offer['time_offered'] = $dateTime->format('j. n. Y H:i');
}

$agency = new Agencies(0, '', '', '');
foreach ($agencies as $a) {
	if($a['id'] == $offer['agency_id']) {
		$agency = $a;	
	}
}

$isFollowing = false;
foreach ($homeCustomers as $hc) {
  if($hc['customer_id'] == $customer['id'] && $hc['home_id'] == $id) {
    $isFollowing = true;
  }
}
if(!empty($_POST) && !empty($_POST['follow'])) {
  if($customer != null && !$isFollowing) {
    $today = new DateTime();
    $todayStr = $today->format('Y-m-d H:m:s');
    $homeCustomer = new homeCustomers($customer['id'], $todayStr, $id);
    homeCustomersDB->create($homeCustomer);
    $isFollowing = true;
  } else if($customer != null && $isFollowing) {
    homeCustomersDB->deleteByIds($customer['id'], $id);
    $isFollowing = false;
  }
}

if (!empty($_POST) && !empty($_POST['message'])) {
    $messageText = htmlspecialchars($_POST['message']);
    $sender = $email; 
    $recipient = $agency['email']; 
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/' . phpversion()
    ];
    $messageHTML = '<h1>Nová zpráva od "'.$sender.'"</h1><p>'.$messageText.'</p>';
    mail($recipient, 'DReality zpráva', $messageHTML, implode("\r\n", $headers));
}
