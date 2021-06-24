<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class MainController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
