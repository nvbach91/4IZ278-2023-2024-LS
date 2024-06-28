<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        return view('profile.index')
            ->with('users', User::paginate(5));
    }

    /**
     * Display the specified resource.
     */
    public function show(?User $user = null): View
    {
        $user = $user ?? auth()->user();
        $this->authorize('view', $user);

        return view('profile.show')
            ->with('user', $user)
            ->with('cats', $user->cats()->paginate(5, ['*'], 'catPage')->fragment('cats'))
            ->with('reviews', $user->reviewsAsSitter()->paginate(5, ['*'], 'reviewPage')->fragment('reviews'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(?User $user = null): View
    {
        $user = $user ?? auth()->user();
        $this->authorize('update', $user);

        return view('profile.edit')
            ->with('user', $user);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, ?User $user = null): RedirectResponse
    {
        /** @var User */
        $user = $user ?? auth()->user();
        $this->authorize('update', $user);


        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->role = 0;
        }

        if ($request->hasFile('avatar')) {
            if ($path = $request->file('avatar')->store('avatars', 'public')) {
                $user->avatar_path = $path;
            }
        } else if ($request->boolean('delete_avatar')) {
            $user->avatar_path = null;
        }

        if ($user->hasVerifiedEmail() && !$user->isAdmin()) {
            $user->role = $request->boolean('is_sitter');
        }

        $user->save();

        return back()->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, ?User $user = null): RedirectResponse
    {
        /** @var User */
        $user = $user ?? auth()->user();
        $this->authorize('delete', $user);

        if (auth()->user()->id === $user->id) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            auth()->logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('index');
        } else {
            $email = $user->email;
            $user->delete();

            return to_route('profily.index')
                ->with(['status' => 'profile-deleted', 'email' => $email]);
        }
    }
}
