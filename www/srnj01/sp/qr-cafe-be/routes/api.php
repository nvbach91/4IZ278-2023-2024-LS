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

Route::get('seller/{hash}', [SellerController::class, 'showByHash']);
Route::get('seller/{hash}/generated', [GeneratedController::class, 'index']);
Route::post('seller/{hash}/generated', [GeneratedController::class, 'store']);
Route::get('seller/{hash}/generated/{id}', [GeneratedController::class, 'showWithHash', 'id', 'hash']);
Route::get('seller/{hash}/sequences/{id}/generate', [SequenceController::class, 'nextWithHash', 'id', 'hash']);
Route::get('seller/{hash}/accounts', [AccountController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('clients', ClientController::class)->except(['create', 'edit']);
    Route::resource('sequences', SequenceController::class)->except(['create', 'edit']);
    Route::resource('accounts', AccountController::class)->except(['create', 'edit']);
    Route::resource('api_keys', ApiKeyController::class)->except(['create', 'edit']);
    Route::resource('sellers', SellerController::class)->except(['create', 'edit']);
    Route::resource('generated', GeneratedController::class)->except(['create', 'edit']);
});
