<?php

namespace App\Http\Controllers;

use App\Models\Links;

class WelcomeController extends Controller
{
    public function index()
    {
        $links = Links::all();
        return view('welcome', compact('links'));
    }
}
