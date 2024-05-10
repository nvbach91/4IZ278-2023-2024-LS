<?php
include_once '../controller/OffersDB.php';
include_once '../controller/TagsDB.php';

const offersdb = new OffersDB();
$offers = offersdb->readAll();
const tagsdb = new TagsDB();
$tags = tagsdb->readAll();

$errors = [];
if (!empty($_POST) && !empty($_POST['searchByText']))
{
	$searchText = $_POST['searchByText'];

	$offers = array_filter($offers, function($o) use ($searchText) {return is_numeric(strpos($o['address'], $searchText));});

}
if (!empty($_POST) && !empty($_POST['homeType']))
{
	$homeType = $_POST['homeType'];
	$offerType = $_POST['offerType'];
	$minPrice = $_POST['minPrice'];
	$maxPrice = $_POST['maxPrice'];
	$minSize = $_POST['minSize'];
	$maxSize = $_POST['maxSize'];
	if (!empty($_POST['tag'])) {
		$tag = $_POST['tag'];
	}

    	if(empty($homeType) || !($homeType == 'house' || $homeType == 'apartment')) {
		$homeType = 'house';
	}
	if(empty($offerType) || !($offerType == 'rent' || $offerType == 'buy')) {
		$offerType = 'rent';
	}
	if(empty($minPrice)) {
		$minPrice = PHP_INT_MIN;
	}
	if(empty($maxPrice)) {
		$maxPrice = PHP_INT_MAX;
	}
	if(empty($minSize)) {
		$minSize = PHP_INT_MIN;
	}
	if(empty($maxSize)) {
		$maxSize = PHP_INT_MAX;
	}

	$errors = validateFilter($homeType, $minPrice, $maxPrice, $minSize, $maxSize);

	if (sizeof($errors) == 0) 
	{
		$offers = array_filter($offers, function($o) use ($homeType) {return $o['homeType'] == $homeType;});

		$offers = array_filter($offers, function($o) use ($offerType) {return $o['offerType'] == $offerType;});

		$offers = array_filter($offers, function($o) use ($minPrice) {return $o['price'] > $minPrice;});

		$offers = array_filter($offers, function($o) use ($maxPrice) {return $o['price'] < $maxPrice;});

		$offers = array_filter($offers, function($o) use ($minSize) {return $o['size'] > $minSize;});

		$offers = array_filter($offers, function($o) use ($maxSize) {return $o['size'] < $maxSize;});
		if (!empty($tag)) {
			$validOfferIds = [];
			foreach($tags as $t) {
				if ($tag == $t['tag'])
				{
					array_push($validOfferIds, $t['home_id']);
				}
			}
			$offersWithTag = [];
			foreach ($validOfferIds as $v)
			{
				foreach($offers as $o)
				{
					if($o['id'] == $v)
					{
						array_push($offersWithTag, $o);
					}
				}
			}
			$offers = $offersWithTag;
		}
	}
 
}
function validateFilter($homeType, $minPrice, $maxPrice, $minSize, $maxSize)
{
    $errors = [];

    if (!is_numeric($minPrice)) {
        array_push($errors, "Minimální cena musí být číslo.");
    }

    if (!is_numeric($maxPrice)) {
        array_push($errors, "Maximální cena musí být číslo.");
    }
    
    if (!is_numeric($minSize)) {
        array_push($errors, "Minimální velikost musí být číslo.");
    }

    if (!is_numeric($maxSize)) {
        array_push($errors, "Maximální velikost musí být číslo.");
    }
    
    return $errors;
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
    unset($offer);
}

$tagsforModal = [];
$uniqueTags = [];
foreach ($tags as $t) 
{
	if(!in_array($t['tag'], $uniqueTags)) 
	{
		array_push($tagsforModal, $t);
		array_push($uniqueTags, $t['tag']);
	}
}
