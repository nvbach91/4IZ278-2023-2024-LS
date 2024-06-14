<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableTimeUpdateRequest;
use App\Models\AvailableTime;
use Illuminate\View\View;

class AvailableTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dostupnost.index')
            ->with('futureEvents', auth()->user()->futureAvailableTimes()->paginate(5, ['*'], 'futurePage'))
            ->with('pastEvents', auth()->user()->pastAvailableTimes()->paginate(5, ['*'], 'pastPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dostupnost.edit')
            ->with('event', new AvailableTime);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvailableTimeUpdateRequest $request)
    {
        $event = new AvailableTime;
        $event->fill($request->validated());

        /** @var User */
        $user = auth()->user();
        $user->availableTimes()->save($event);

        return to_route('dostupnost.index')
            ->with('status', 'event-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AvailableTime $event)
    {
        return view('dostupnost.edit')
            ->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvailableTimeUpdateRequest $request, AvailableTime $event)
    {
        $event->fill($request->validated());
        $event->save();

        return to_route('dostupnost.index')
            ->with('status', 'event-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvailableTime $event)
    {
        $event->delete();

        return to_route('dostupnost.index')
            ->with('status', 'event-deleted');
    }
}
