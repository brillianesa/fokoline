<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Store;

class MainController extends Controller
{
    public function index()
    {
        $vendors = Store::all();
        return view('dashboard', compact('vendors'));
    }
}
