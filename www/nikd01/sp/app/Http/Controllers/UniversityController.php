<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return University::latest()->take(10)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('University/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:universities'],
            'location' => ['required'],
            'url' => ['required', 'active_url'],
        ]);

        University::create($request->all());

        return redirect()->route('browse');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university, Request $request)
    {
        $query = $request->input('query', '');
        $subjects = $university->subjects()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', "%{$query}%");
            })
            ->paginate(10);

        return Inertia::render('University/Index', [
            'university' => $university,
            'subjects' => $subjects,
            'query' => $query,
            'canUpdate' => $request->user() && $request->user()->can('update', $university),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university, Request $request)
    {
        if ($request->user()->cannot('update', $university)) {
            abort(403, 'You are not authorized to update this university.');
        }
        return Inertia::render('University/Edit', [
            'university' => $university,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        if ($request->user()->cannot('update', $university)) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', function ($attribute, $value, $fail) use ($university) {
                if ($value !== $university->name) {
                    $exists = University::where('name', $value)->where('id', '!=', $university->id)->exists();
                    if ($exists) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }
            },],
            'location' => ['required'],
            'url' => ['required', 'active_url'],
        ]);

        $university->update($request->all());

        return redirect()->route('browse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university, Request $request)
    {
        if ($request->user()->cannot('delete', $university)) {
            abort(403, 'Unauthorized action.');
        }

        $university->delete();

        return redirect()->route('browse');
    }
}
