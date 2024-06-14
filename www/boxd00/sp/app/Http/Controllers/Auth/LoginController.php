<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // use AuthenticatesUsers;
    protected $redirectTo = "/login";

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Špatné přihlašovací údaje. Zkuste to znovu.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
