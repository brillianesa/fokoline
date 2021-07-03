<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Order, Store
};

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;
        if ($role == 'customer') {
            return redirect(route('order.list'));
        }

        $userStore = Store::getListStore($user);

        if ($role == 'store') {
            $totalOrder = Order::whereIn('store_id', $userStore)->count();
            $totalOrderDone = Order::where('status', Order::PESANAN_SELESAI)->whereIn('store_id', $userStore)->get()->count();
            $orderPerStatus = Order::orderPerStatus($userStore);
        } else {
            $totalOrder = Order::all()->count();
            $totalOrderDone = Order::where('status', Order::PESANAN_SELESAI)->get()->count();
            $orderPerStatus = Order::orderPerStatus();
        }

        return view('admin.index', compact('totalOrder', 'totalOrderDone', 'orderPerStatus'));
    }
}
