<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardSet;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

const CARD_DISPLAY_LIMIT = 10;

class CardController extends Controller
{

    public function showOwn(Request $request)
    {
        $user = $request->user();

        $totalCards = $user->cards;
        $totalCardCount = $totalCards->sum('pivot.count');

        if ($totalCards->count() === 0) {
            return Inertia::render('Collection/MyCollection', [
                'page' => 1,
                'totalPages' => 1,
                'cards' => [],
                'totalCardCount' => 0,
                'searchQuery' => '',
            ]);
        }


        $page = $request->query('page', 1);
        $searchQuery = $request->query('searchQuery', '');

        if ($searchQuery) {
            $totalCards = $totalCards->filter(function ($card) use ($searchQuery) {
                return stripos($card->name, $searchQuery) !== false;
            });
        }

        $cards = $totalCards->forPage($page, CARD_DISPLAY_LIMIT)->values();

        $totalPages = ceil($totalCards->count() / CARD_DISPLAY_LIMIT);

        if ($page > $totalPages) {
            return Redirect::route('card.showOwn', ['page' => $totalPages]);
        }

        return Inertia::render('Collection/MyCollection', [
            'page' => (int)$page,
            'totalPages' =>  $totalPages,
            'cards' => $cards->load('cardSet')->map(function ($card) {
                return $this->toPokemonCard($card);
            }),
            'totalCardCount' => $totalCardCount,
            'searchQuery' => $searchQuery,
        ]);
    }

    public function showSearch()
    {
        return Inertia::render('Cards/Search');
    }

    public function addToCollection(Request $request, $cardId)
    {
        $validated = $request->validate([
            'count' => 'required|integer',

            'name' => 'required|string',
            'supertype' => 'required|string',
            'type' => 'nullable|string',
            'subtype' => 'nullable|string',
            'image_small_url' => 'required|string',
            'image_large_url' => 'required|string',

            'set_id' => 'required|string',
            'set_name' => 'required|string',
            'set_symbol_url' => 'required|string',
            'set_logo_url' => 'required|string',
        ]);

        $card = $this->storeCardAndCardSet(array_merge($validated, ['card_id' => $cardId]));

        $user = $request->user();

        $userCard = $user->cards()->find($card->id);

        if ($userCard) {
            $user->cards()->updateExistingPivot($card->id, [
                'count' => $userCard->pivot->count + $request->count,
            ]);
        } else {
            $user->cards()->attach($card->id, ['count' => $request->count]);
        }

        return response()->json(['message' => 'Card added or created and attached to user successfully.']);
    }

    public function changeCollectionCount(Request $request, $cardId)
    {
        $validated = $request->validate([
            'count' => 'required|integer',
        ]);

        $request
            ->user()
            ->cards()
            ->updateExistingPivot($cardId, ['count' => $validated['count']]);

        return Redirect::route('card.showOwn', $request->query());
    }

    public function removeFromCollection(Request $request, $cardId)
    {
        $request
            ->user()
            ->cards()
            ->detach($cardId);

        return Redirect::route('card.showOwn', $request->query());
    }

    public function addToDeck(Request $request, $deckId, $cardId)
    {

        $validated = $request->validate([
            'count' => 'required|integer',

            'name' => 'required|string',
            'supertype' => 'required|string',
            'type' => 'nullable|string',
            'subtype' => 'nullable|string',
            'image_small_url' => 'required|string',
            'image_large_url' => 'required|string',

            'set_id' => 'required|string',
            'set_name' => 'required|string',
            'set_symbol_url' => 'required|string',
            'set_logo_url' => 'required|string',
        ]);

        $card = $this->storeCardAndCardSet(array_merge($validated, ['card_id' => $cardId]));

        $deck = Deck::findOrFail($deckId);

        $this->authorize('update', $deck);

        $deckCard = $deck->cards()->find($card->id);

        if ($deckCard) {
            $deck->cards()->updateExistingPivot($card->id, [
                'count' => $deckCard->pivot->count + $request->count,
            ]);
        } else {
            $deck->cards()->attach($card->id, ['count' => $request->count]);
        }

        return response()->json(['message' => 'Card added or created and attached to deck successfully.']);
    }

    public function changeDeckCount(Request $request, $deckId, $cardId)
    {
        $validated = $request->validate([
            'count' => 'required|integer',
        ]);

        $deck = Deck::findOrFail($deckId);

        $this->authorize('update', $deck);

        $deck->cards()->updateExistingPivot($cardId, [
            'count' => $validated['count'],
        ]);

        return Redirect::route('deck.show', $request->query());
    }

    public function removeFromDeck(Request $request, $deckId, $cardId)
    {
        $deck = Deck::findOrFail($deckId);

        $this->authorize('update', $deck);

        $deck->cards()->detach($cardId);

        return Redirect::route('deck.show', $request->query());
    }

    private function storeCardAndCardSet($data)
    {
        $cardSet = CardSet::find($data['set_id']);

        if (!$cardSet) {
            $cardSet = CardSet::create([
                'id' => $data['set_id'],
                'name' => $data['set_name'],
                'symbol_url' => $data['set_symbol_url'],
                'logo_url' => $data['set_logo_url'],
            ]);
        }

        $card = Card::find($data['card_id']);

        if (!$card) {
            $card = Card::create([
                'id' => $data['card_id'],
                'name' => $data['name'],
                'supertype' => $data['supertype'],
                'type' => $data['type'],
                'subtype' => $data['subtype'],
                'set_id' => $data['set_id'],
                'image_small_url' => $data['image_small_url'],
                'image_large_url' => $data['image_large_url'],
            ]);
        }

        return $card;
    }

    public function showStatistics()
    {

        $this->authorize('viewStatistics', User::class);

        $mostOwnedCardsInCollections = $this->getSortedCardsByOverallCount(
            User::all()
                ->map(function ($user) {
                    return $user->cards;
                })
        );

        $mostUsedCardsInDecks = $this->getSortedCardsByOverallCount(
            Deck::all()
                ->map(function ($deck) {
                    return $deck->cards;
                })
        );

        return Inertia::render('Admin/Statistics', [
            'mostOwnedCardsInCollections' => $mostOwnedCardsInCollections,
            'mostUsedCardsInDecks' => $mostUsedCardsInDecks,
        ]);
    }

    private function getSortedCardsByOverallCount($cards)
    {
        return $cards
            ->flatten()
            ->groupBy('id')
            ->map(function ($group) {
                $pokemonCard = $this->toPokemonCard($group->first());
                return array_merge($pokemonCard, ['count' => $group->sum('pivot.count')]);
            })
            ->sortByDesc(function ($card) {
                return $card['count'];
            })
            ->values();
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
