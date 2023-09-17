<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view("register.index");
    }

    public function register(Request $request): RedirectResponse {

        $validatedData = $request->validate([
            "email" => "required|unique:users",
            "name" => "required|min:4",
            "password" => "required"
        ]);

        $validatedData["password"] = bcrypt($validatedData["password"]);

        User::create($validatedData);

        return redirect("/login")->with("success", "Successfully create new account! Please Login");

    }
}
