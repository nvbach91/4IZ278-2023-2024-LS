<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $user = $request->user();
    if ($user === null) {
        return Inertia::render('Welcome');
    }
    return Redirect::route('card.showOwn');
});

Route::get('/explore-decks', [DeckController::class, 'showAll'])->name('deck.showAll');
Route::get('/decks/{id}', [DeckController::class, 'show'])->name('deck.show');
Route::get('/search-card', [CardController::class, 'showSearch'])->name('card.showSearch');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/my-collection', [CardController::class, 'showOwn'])->name('card.showOwn');

    Route::get('/my-decks', [DeckController::class, 'showOwn'])->name('deck.showOwn');
    Route::get('/add-deck', [DeckController::class, 'add'])->name('deck.add');
    Route::get('/edit-deck/{id}', [DeckController::class, 'edit'])->name('deck.edit');

    Route::get('/user/decks', [DeckController::class, 'getOwnDecks'])->name('deck.getOwnDecks');

    Route::post('/user/addCard/{id}', [CardController::class, 'addToCollection'])->name('card.addToCollection');
    Route::post('/user/changeCardCount/{id}', [CardController::class, 'changeCollectionCount'])->name('card.changeCollectionCount');
    Route::post('/user/deleteCard/{id}', [CardController::class, 'removeFromCollection'])->name('card.removeFromCollection');

    Route::post('/decks/create', [DeckController::class, 'create'])->name('deck.create');
    Route::post('/decks/update/{id}', [DeckController::class, 'update'])->name('deck.update');
    Route::post('/decks/delete/{id}', [DeckController::class, 'delete'])->name('deck.delete');

    Route::post('/decks/{deckId}/addCard/{cardId}', [CardController::class, 'addToDeck'])->name('card.addToDeck');
    Route::post('/decks/{deckId}/changeCardCount/{cardId}', [CardController::class, 'changeDeckCount'])->name('card.changeDeckCount');
    Route::post('/decks/{deckId}/deleteCard/{cardId}', [CardController::class, 'removeFromDeck'])->name('card.removeFromDeck');

    Route::get('admin', [UserController::class, 'showAll'])->name('user.showAll');
    Route::get('statistics', [CardController::class, 'showStatistics'])->name('user.showStatistics');

    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('decks', DeckController::class);
