<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApiKeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GeneratedController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SequenceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('clients', ClientController::class)->except(['create', 'edit']);
    Route::resource('sequences', SequenceController::class)->except(['create', 'edit']);
    Route::resource('accounts', AccountController::class)->except(['create', 'edit']);
    Route::resource('api_keys', ApiKeyController::class)->except(['create', 'edit']);
    Route::resource('sellers', SellerController::class)->except(['create', 'edit']);
    Route::resource('generated', GeneratedController::class)->except(['create', 'edit']);
});

Route::post('generated', [GeneratedController::class, 'store']);
Route::get('generated', [GeneratedController::class, 'index']);
Route::get('generated/{generated}', [GeneratedController::class, 'show']);
Route::put('generated/{generated}', [GeneratedController::class, 'update']);
Route::delete('generated/{generated}', [GeneratedController::class, 'destroy']);
Route::get('seller/{hash}', [SellerController::class, 'showByHash']);
