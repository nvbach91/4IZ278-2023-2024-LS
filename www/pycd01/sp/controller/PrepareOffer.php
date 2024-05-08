<?php

include_once '../controller/OffersDB.php';
include_once '../controller/TagsDB.php';
include_once '../controller/AgenciesDB.php';
if(empty($_GET['id'])) {
	header('Location: main.php');
}
$id = $_GET['id'];
const offersdb = new OffersDB();
$offers = offersdb->read($id);
$offer = $offers[0];
const tagsdb = new TagsDB();
$tags = tagsdb->readAll();
const agenciesDB = new AgenciesDB();
$agencies = agenciesDB->readAll();

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
}
$agency = new Agencies(0, '', '', '');
foreach ($agencies as $a) {
	if($a['id'] == $offer['agency_id']) {
		$agency = $a;	
	}
}
