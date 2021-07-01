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
        $role = $user->role;
        $store = Store::getListStore($user);

        if ($request->ajax()) {
            $data = Order::getDataByRole();
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

    public function createForm($storeId)
    {
        $store = Store::findOrFail($storeId);

        return view('admin.order.order-create', compact('store'));
    }

    public function createAction(Request $request)
    {
        dd($request);
    }
}
