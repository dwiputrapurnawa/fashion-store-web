<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view("login.index");
    }

    public function login(Request $request): RedirectResponse {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(Auth::attempt($credentials, $request->rememberme)) {
            $request->session()->regenerate();

            return redirect()->intended("/");
        }

        return back()->with("error", "Login failed!");
    }

    public function logout(Request $request): RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");

    }
}
