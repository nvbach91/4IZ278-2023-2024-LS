<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view("index");
})->name("index");

Route::get("/about", function() {
    return view("about");
})->name("about");

Route::get("/destinations", function() {
    return view("destinations");
})->name("destinations");

Route::get("/membership", function() {
    return view("membership");
})->name("membership");

Route::get("/tickets", function() {
    return view("tickets");
})->name("tickets");

Route::get("/login", function() {
    return view("login");
})->name("login");