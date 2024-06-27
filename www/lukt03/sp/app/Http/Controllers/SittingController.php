<?php

namespace App\Http\Controllers;

use App\Models\AvailableTime;
use App\Models\Sitting;
use App\Models\User;
use App\Notifications\SittingCancelled;
use App\Notifications\SittingConfirmed;
use App\Notifications\SittingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SittingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Sitting::class, 'sitting');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /** @var User */
        $user = auth()->user();
    
        if ($user->isAdmin()) {
            return view('sitting.index')
                ->with('sittings', Sitting::query()->orderBy('id', 'desc')->paginate(5));
        } else {
            return view('sitting.index-my')
                ->with('sittingsAsSitter', auth()->user()->sittingsAsSitter)
                ->with('sittingsAsOwner', auth()->user()->sittingsAsOwner);
        }
    }

    public function find(Request $request): View
    {
        $query = User::query();
        $query->where('role', 1);
        $query->when(Auth::check(), fn($q) => $q->where('id', '<>', auth()->user()->id));
        $query->when(null !== $request->query('location'), fn($q) => $q->where('location', 'like', '%' . $request->query('location') . '%'));
        $sitters = $query->paginate(4);

        return view('findSitter')
            ->with('sitters', $sitters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $availableTime = AvailableTime::find($request->availabilityId);

        if (is_null($availableTime)) {
            return back();
        }

        $sitting = new Sitting;
        $sitting->owner_id = auth()->user()->id;
        $sitting->sitter_id = $availableTime->sitter_id;
        $sitting->start = $availableTime->start;
        $sitting->end = $availableTime->end;
        $sitting->save();

        $sitting->sitter->notify(new SittingRequest($sitting));

        return to_route('hlidani.index')
            ->with('status', 'sitting-created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sitting $sitting): RedirectResponse
    {
        $this->authorize('update', auth()->user());

        $sitting->status = 1;
        $sitting->save();

        $sitting->owner->notify(new SittingConfirmed($sitting));

        return to_route('hlidani.index')
            ->with('status', 'sitting-confirmed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sitting $sitting): RedirectResponse
    {
        $sitting->status = 2;
        $sitting->save();
    
        if (auth()->user()->id === $sitting->sitter->id) {
            $sitting->owner->notify(new SittingCancelled($sitting, $otherUser = $sitting->sitter));
        } else {
            $sitting->sitter->notify(new SittingCancelled($sitting, $otherUser = $sitting->owner));
        }
 
        return to_route('hlidani.index')
            ->with('status', 'sitting-deleted');
    }
}
