<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CardSet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

const USER_DISPLAY_LIMIT = 10;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAll(Request $request)
    {
        $totalUsers = User::all();
        $totalUserCount = $totalUsers->count();

        if ($totalUsers->count() === 0) {
            return Inertia::render('Admin/Admin', [
                'page' => 1,
                'totalPages' => 1,
                'users' => [],
                'totalUserCount' => 0,
            ]);
        }

        $this->authorize('viewAll', User::class);

        $searchQuery = $request->query('searchQuery', '');

        if ($searchQuery) {
            $totalUsers = $totalUsers->filter(function ($user) use ($searchQuery) {
                return stripos($user->name, $searchQuery) !== false;
            });
        }

        $page = $request->query('page', 1);

        $users = $totalUsers->forPage($page, USER_DISPLAY_LIMIT)->values();

        $totalPages = ceil($totalUsers->count() / USER_DISPLAY_LIMIT);

        if ($page > $totalPages) {
            return Redirect::route('user.showAll', ['page' => $totalPages]);
        }

        return Inertia::render('Admin/Admin', [
            'page' => (int)$page,
            'totalPages' => $totalPages,
            'users' => $users,
            'totalUserCount' => $totalUserCount,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $card = CardSet::findOrFail($id);
        return response()->json($card);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'privilege' => 'required|numeric',
        ]);

        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'privilege' => $validated['privilege'],
        ]);

        return Redirect::route('user.showAll', $request->query());
    }

    public function delete(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        $user->delete();

        return Redirect::route('user.showAll', $request->query());
    }
}
