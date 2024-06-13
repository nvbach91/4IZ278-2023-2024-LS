<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }
        return redirect()->route('dashboard');
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('email', $facebookUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
                'password' => Hash::make(uniqid()),
            ]);

            $account = Account::create([
                'display_name' => 'Hlavní účet',
                'balance' => 0,
            ]);

            AccountPermission::create([
                'account_id' => $account->id,
                'user_id' => $user->id,
                'permission' => 'owner',
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
