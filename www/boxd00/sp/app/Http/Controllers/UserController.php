<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8|max:255",
            "firstName" => "required|string|max:255",
            "lastName" => "required|string|max:255",
            "birthDate" => "required|date",
            "phone" => "required|string|max:13",
            "isStudent" => "string" // on/off -> true/false
        ]);

        if ($validator->fails()) {
            return redirect("/login")->withErrors($validator)->withInput();
        }

        if (User::where('email', $request->input("email"))->exists()) {
            return redirect()->route("login")->with("error", "Tato e-mailová adresa je již zaregistrována.");
        }

        $user = new User();
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->first_name = $request->input("firstName");
        $user->last_name = $request->input("lastName");
        $user->birth_date = $request->input("birthDate");
        $user->is_student = $request->input("isStudent") == true;
        $user->membership = 0;
        $user->is_admin = false;

        $phone = $request->input("phone");
        if (strlen($phone) == 9) {
            $phone = "+420" . $phone;
        }
        $user->phone = $phone;
        $user->save();

        return redirect('/login')->with('status', 'registered');
    }

    public function myProfile() {
        $user = Auth::user();

        return view("profile", ["user" => $user]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        $email = $request->input("email");
        $oldPassword = $request->input("oldPassword");
        $password = $request->input("password");
        $confirm = $request->input("confirm");
        $phone = $request->input("phone");

        if (Hash::check($oldPassword, $user->password)) {
            return redirect()->route("profile")->with("error", "Zadali jste špatné heslo.");
        }

        if ($password != "" && $confirm != "") {
            $user->password = Hash::make($password);
        }

        $user->email = $email;
        $user->phone = $phone;

        return redirect()->route("profile")->with("success", "Vaše údaje byly změněny.");
    }
}
