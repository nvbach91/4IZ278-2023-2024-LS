<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;


// Route::get('/', function() {
//     return view("index");
// })->name("index");
Route::get('/', [DestinationController::class, 'index'])->name("index");

Route::get("/about", function() {
    return view("about");
})->name("about");

Route::get("/destinations", [DestinationController::class, "destinations"])->name("destinations");

Route::get("/membership", function() {
    return view("membership");
})->name("membership")->middleware("auth");

Route::get("/tickets", [TicketController::class, "allTickets"])->name("tickets")->middleware("auth");

Route::get("/mytickets", [TicketController::class, "myTickets"])->name("mytickets")->middleware("auth");

Route::get("/connections", [FlightController::class, "find"])->name("connections");

Route::get('/buyticket', [TicketController::class, 'beforeBuy'])->name("buyticket");
Route::post("/addticket", [TicketController::class, "add"])->name("addticket");
Route::delete("/deleteticket", [TicketController::class, "delete"])->name("deleteticket");

Route::get("/cart", function() {
    return view("cart");
})->name("cart");

Route::get("/payment", [PaymentController::class, "loadForm"])->name("payment");
Route::post("/payment", [PaymentController::class, "pay"])->name("pay");

Route::get("/profile", [UserController::class, "myProfile"])->name("profile")->middleware("auth");
Route::put("/profile", [UserController::class, "update"])->name("updateProfile")->middleware("auth");

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware("auth");

Route::post('/registeruser', [UserController::class, 'register']);