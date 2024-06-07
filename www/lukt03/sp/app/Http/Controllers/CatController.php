<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatUpdateRequest;
use App\Models\Cat;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CatController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Cat::class, 'cat');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /** @var User */
        $user = auth()->user();
    
        if ($user->isAdmin()) {
            return view('cat.index')
                ->with('cats', Cat::all());
        } else {
            return view('cat.index-my')
                ->with('cats', auth()->user()->cats ?? []);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cat.edit')
            ->with('cat', new Cat);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatUpdateRequest $request): RedirectResponse
    {
        $cat = new Cat;
        $cat->fill($request->validated());

        if ($request->hasFile('photo')) {
            if ($path = $request->file('photo')->store('public/cats')) {
                $cat->photo_path = $path;
            }
        } else if ($request->boolean('delete_photo')) {
            $cat->photo_path = null;
        }

        /** @var User */
        $user = auth()->user();
        $user->cats()->save($cat);

        return to_route('kocky.index')
            ->with('status', 'cat-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cat $cat): View
    {
        return view('cat.edit')
            ->with('cat', $cat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatUpdateRequest $request, Cat $cat): RedirectResponse
    {
        $cat->fill($request->validated());

        if ($request->hasFile('photo')) {
            if ($path = $request->file('photo')->store('public/cats')) {
                $cat->photo_path = $path;
            }
        } else if ($request->boolean('delete_photo')) {
            $cat->photo_path = null;
        }

        $cat->save();

        return to_route('kocky.index')
            ->with('status', 'cat-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat): RedirectResponse
    {
        $name = $cat->name;
        $cat->delete();

        return to_route('kocky.index')
            ->with(['status' => 'cat-deleted', 'name' => $name]);
    }
}
