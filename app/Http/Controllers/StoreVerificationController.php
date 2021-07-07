<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Store;
use App\Models\User;

class StoreVerificationController extends Controller
{
    public function     index(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::with('user')->where('is_verified', null);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = "
                        <div class='col-md-12 text-center'>
                            <a href='" . route('store.approval', $row->id) . "' class='btn btn-success btn-sm'> Persetujuan </a>
                        </div>
                    ";

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.store.store-verification');
    }

    public function approval($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.store.approval', compact('store'));
    }

    public function approvalAction($id, $action)
    {
        $store = Store::findOrFail($id);
        $is_verified = false;

        if ($action == 'accept') {
            $is_verified = true;
        }

        $store->is_verified = $is_verified;
        $store->update();

        $user = User::findOrFail($store->user->id);
        $user->role = 'store';
        $user->update();

        return redirect(route('store.verification'));
    }
}
