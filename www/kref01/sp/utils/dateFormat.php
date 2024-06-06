<?php

class DateFormat {
    public static function readableDate($date) {
        $timestamp = strtotime($date);
        return date("F j, Y", $timestamp);
    }
    public static function readableDateTime($date) {
        $timestamp = strtotime($date);
        return date("F j, Y, g:i A", $timestamp);
    }
}
?>
