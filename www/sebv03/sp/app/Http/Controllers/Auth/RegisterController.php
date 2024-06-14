<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function show()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
       $account = Account::create([
            'display_name' => $user->name . '\'s Account',
            'balance' => 100
        ]);
        AccountPermission::create([
            'user_id' => $user->id,
            'account_id' => $account->id,
            'permission' => 'owner'
        ]);
        Auth::login($user, true);
        $this->sendWelcomeMail($user);
        return redirect()->route('dashboard');

    }
    private function sendWelcomeMail(User $user)
    {
        define('ADRESS', 'sebv03@vse.cz');
        define('SUBJECT', 'Welcome internet banking');
        define('message', 'Welcome to our internet banking. You have been registered successfully.');
        $headers  = [
            'MIME-Version: 1.0',
            'Content-type: text/plain; charset=utf-8',
            'From: '.ADRESS,
            'Reply-To: '.ADRESS,
            'X-Mailer: PHP/'.phpversion()
        ];
        $headers = implode("\r\n", $headers);
        mail($user->email, SUBJECT, message, $headers);
    }

}
