<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'photo_url' => $this->getUserAvatarUrl($request->user()),
        ]);
    }

    /**
     * Show other user's profile
     */
    public function show(Request $request, int $id): View
    {
        $user = User::find($id);

        if (is_null($user)) {
            throw new ModelNotFoundException('Uživatelský účet neexistuje');
        }
        if ($user->role !== 1 && $request->user()->id !== $id && $request->user()->role < 2) {
            throw new AuthorizationException('Tento profil nelze zobrazit');
        }

        return view('profile.show', [
            'name' => $user->name,
            'hidden' => $user->role !== 1,
            'location' => $user->location,
            'photo_url' => $this->getUserAvatarUrl($user),
            'joined' => $user->created_at->format('Y-m-d'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/avatars');
            if ($user->photo_url !== null) {
                Storage::delete($user->photo_url);
            }
            $user->photo_url = $path;
        }

        if ($user->role < 2) {
            $user->role = $request->boolean('is_sitter');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function getUserAvatarUrl(User $user)
    {
        return Storage::url($user->photo_url ?? 'avatars/placeholder.png');
    }
}
