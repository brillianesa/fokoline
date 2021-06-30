<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

use App\Models\{
    Order, Store
};

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $store = Store::getListStore($user);


        if ($request->ajax()) {
            $data = Order::with('user', 'store')->whereIn('store_id', $store);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = "";
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.order.order-list');
    }

    public function create($storeId)
    {
        return view('admin.order.order-create');
    }
}
