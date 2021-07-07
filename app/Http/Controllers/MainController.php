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
        $vendors = Store::where('is_verified', 1)->get();
        return view('dashboard', compact('vendors'));
    }

    public function about()
    {
        return view('about');
    }

    public function store()
    {
        $vendors = Store::where('is_verified', 1)->get();
        return view('store', compact('vendors'));
    }
}
