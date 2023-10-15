<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return view("admin.customers.index", [
            "users" => User::all(),
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required"
        ]);

        $validatedData["password"] = bcrypt($validatedData["password"]);

        User::create($validatedData);

        return back()->with("message", "Successfully created new user");
    }

    public function update(Request $request) {
        
        $validatedData = $request->validate([
            "name" => "required",
        ]);

        if($request->password) {
            $validatedData["password"] = bcrypt($request->password);
        }

        User::where("id", $request->user_id)->update($validatedData);

        return back()->with("message", "Successfully updated data");
    }

    public function destroy(Request $request) {
        $validatedData = $request->validate([
            "user_id" => "required"
        ]);

        User::where("id", $validatedData["user_id"])->delete();

        return back()->with("message", "Successfully deleted user");
    }
}
