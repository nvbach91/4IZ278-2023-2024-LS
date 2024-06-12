<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\ProfileController;
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

    Route::put('/user/cards/{id}', [CardController::class, 'addToCollection'])->name('card.addToCollection');
    Route::patch('/user/cards/{id}', [CardController::class, 'changeCollectionCount'])->name('card.changeCollectionCount');
    Route::delete('/user/cards/{id}', [CardController::class, 'removeFromCollection'])->name('card.removeFromCollection');

    Route::post('/decks/create', [DeckController::class, 'create'])->name('deck.create');
    Route::put('/decks/update/{id}', [DeckController::class, 'update'])->name('deck.update');
    Route::delete('/decks/delete/{id}', [DeckController::class, 'delete'])->name('deck.delete');

    Route::put('/decks/{deckId}/cards/{cardId}', [CardController::class, 'addToDeck'])->name('card.addToDeck');
    Route::patch('/decks/{deckId}/cards/{cardId}', [CardController::class, 'changeDeckCount'])->name('card.changeDeckCount');
    Route::delete('/decks/{deckId}/cards/{cardId}', [CardController::class, 'removeFromDeck'])->name('card.removeFromDeck');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('decks', DeckController::class);
