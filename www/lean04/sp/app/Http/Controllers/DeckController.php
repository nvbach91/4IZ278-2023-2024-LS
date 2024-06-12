<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

const DECK_DISPLAY_LIMIT = 9;
const DECK_CARD_DISPLAY_LIMIT = 10;

class DeckController extends Controller
{
    public function add()
    {
        return Inertia::render('Decks/Add');
    }

    public function showAll(Request $request)
    {
        $totalDecks = Deck::all();

        if ($totalDecks->count() === 0) {
            return Inertia::render('Decks/Explore', [
                'page' => 1,
                'totalPages' => 1,
                'decks' => [],
            ]);
        }

        $page = $request->query('page', 1);

        $decks = $totalDecks->forPage($page, DECK_DISPLAY_LIMIT)->values();

        $totalPages = ceil($totalDecks->count() / DECK_DISPLAY_LIMIT);

        if ($page > $totalPages) {
            return Redirect::route('deck.showAll', ['page' => $totalPages]);
        }

        return Inertia::render('Decks/Explore', [
            'page' => (int)$page,
            'totalPages' => $totalPages,
            'decks' => $decks,
        ]);
    }

    public function showOwn(Request $request)
    {

        $totalOwnDecks = Deck::where('owner_id', $request->user()->id)->get();

        if ($totalOwnDecks->count() === 0) {
            return Inertia::render('Decks/MyDecks', [
                'page' => 1,
                'totalPages' => 1,
                'decks' => [],
            ]);
        }

        $page = $request->query('page', 1);

        $decks = $totalOwnDecks->forPage($page, DECK_DISPLAY_LIMIT)->values();

        $totalPages = ceil($totalOwnDecks->count() / DECK_DISPLAY_LIMIT);

        if ($page > $totalPages) {
            return Redirect::route('deck.showOwn', ['page' => $totalPages]);
        }

        return Inertia::render('Decks/MyDecks', [
            'page' => (int)$page,
            'totalPages' => $totalPages,
            'decks' => $decks,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Deck::class);

        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $deck = Deck::create([
            'name' => $validated['name'],
            'owner_id' => $request->user()->id,
        ]);

        return Redirect::route('deck.show', ['id' => $deck->id]);
    }

    public function edit(string $id)
    {
        $deck = Deck::findOrFail($id);
        $this->authorize('update', $deck);
        return Inertia::render('Decks/Edit', [
            'deck' => $deck,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $deck = Deck::findOrFail($id);

        $this->authorize('update', $deck);

        $deck->update([
            'name' => $validated['name'],
        ]);

        return Redirect::route('deck.show', ['id' => $deck->id]);
    }

    public function show(Request $request, string $id)
    {

        $deck = Deck::findOrFail($id);

        $deckCards = $deck->cards;
        $totalCardCount = $deckCards->sum('pivot.count');

        if ($deckCards->count() === 0) {
            return Inertia::render('Decks/Detail', [
                'page' => 1,
                'totalPages' => 1,
                'deck' => $deck,
                'cards' => [],
                'totalCardCount' => 0,
                'searchQuery' => '',
            ]);
        }

        $page = $request->query('page', 1);
        $searchQuery = $request->query('searchQuery', '');

        if ($searchQuery) {
            $deckCards = $deckCards->filter(function ($card) use ($searchQuery) {
                return stripos($card->name, $searchQuery) !== false;
            });
        }

        $cards = $deckCards->forPage($page, DECK_CARD_DISPLAY_LIMIT)->values();

        $totalPages = ceil($deckCards->count() / DECK_CARD_DISPLAY_LIMIT);

        if ($page > $totalPages) {
            return Redirect::route('deck.show', ['id' => $id, 'page' => $totalPages]);
        }

        return Inertia::render('Decks/Detail', [
            'page' => (int)$page,
            'totalPages' =>  $totalPages,
            'deck' => $deck,
            'cards' => $cards->load('cardSet')->map(function ($card) {
                return $this->toPokemonCard($card);
            }),
            'totalCardCount' => $totalCardCount,
            'searchQuery' => $searchQuery,
        ]);
    }

    public function getOwnDecks(Request $request)
    {
        $decks = Deck::where('owner_id', $request->user()->id)->get();
        return response()->json($decks);
    }

    public function delete(string $id)
    {
        $deck = Deck::findOrFail($id);

        $this->authorize('delete', $deck);

        $deck->delete();

        return Redirect::route('deck.showOwn');
    }

    private function toPokemonCard($card)
    {
        return [
            'id' => $card->id,
            'name' => $card->name,
            'supertype' => $card->supertype,
            'types' => [$card->type],
            'subtypes' => [$card->subtype],
            'set' => [
                'id' => $card->cardSet->id,
                'name' => $card->cardSet->name,
                'images' => [
                    'symbol' => $card->cardSet->symbol_url,
                    'logo' => $card->cardSet->logo_url,
                ],
            ],
            'images' => [
                'small' => $card->image_small_url,
                'large' => $card->image_large_url,
            ],
            'count' => $card->pivot->count,
        ];
    }
}
