<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role == 'customer') {
            return redirect(route('order.list'));
        }

        $totalOrder = Order::all()->count();
        $totalOrderDone = Order::where('status', Order::PESANAN_SELESAI)->get()->count();

        $orderPerStatus = Order::orderPerStatus();

        return view('admin.index', compact('totalOrder', 'totalOrderDone', 'orderPerStatus'));
    }
}
