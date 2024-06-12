<?php

function formatPrice($number): bool|string
{
    $fmt = numfmt_create('cs', NumberFormatter::CURRENCY);
    return numfmt_format_currency($fmt, $number, "CZK");
}


function formatDateTimestamp($timestamp): string
{
    $time = new DateTime($timestamp);
    $time->setTimezone(new DateTimeZone('CET'));
    return $time->format('H:i, d.m.Y');
}

