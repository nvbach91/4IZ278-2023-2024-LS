<?php

use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
})->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'show'])
        ->name('profil.show');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])
        ->name('profil.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])
        ->name('profil.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])
        ->name('profil.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('profily', ProfileController::class)
        ->only(['index', 'show', 'edit', 'update', 'destroy'])
        ->parameter('profily', 'user')
        ->missing(fn () => throw new NotFoundHttpException('Účet neexistuje'));

    Route::resource('kocky', CatController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->parameters(['kocky' => 'cat'])
        ->missing(fn () => throw new NotFoundHttpException('Kočka neexistuje'));

    Route::resource('dostupnost', AvailableTimeController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->parameters(['dostupnost' => 'event']);
});

Route::fallback(fn () => throw new NotFoundHttpException('Stránka nenalezena'));

require __DIR__.'/auth.php';
