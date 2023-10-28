<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AccountSettingsController extends Controller
{
    public function index() {
        return view("account_settings.index", [
            "categories" => Category::all(),
        ]);
    }

    public function change_password_index() {
        return view("account_settings.change_password.index", [
            "categories" => Category::all(),
        ]);
    }
}
