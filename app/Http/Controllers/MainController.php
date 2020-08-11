<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
