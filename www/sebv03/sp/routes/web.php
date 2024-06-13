<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
Route::get('/dashboard', [AccountController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/account/{account}', [AccountController::class, 'show'])->name('account.show')->middleware('auth');
Route::get('/account/{account}/make-payment', [TransactionController::class, 'create'])->name('account.make-payment')->middleware('auth');
Route::post('/account/{account}/make-payment', [TransactionController::class, 'store'])->name('account.make-payment')->middleware('auth');
