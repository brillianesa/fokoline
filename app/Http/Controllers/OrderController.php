<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

use App\Models\{
    Order, Store
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function createAction(Request $request, $id)
    {
        request()->validate([
            'file'   => 'required|mimes:doc,pdf,docx',
            'print_type' => 'required',
            'total_page' => 'required',
            'total_copy' => 'required',
            'paper_type' => 'required',
            'description' => 'nullable',
            'jilid' => 'nullable'
        ]);

        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();
        $fileUploaded = Storage::putFileAs("documents", $file, $filename);

        $data = [
            'customer_id' => Auth::user()->id,
            'store_id' => $id,
            'file' => $filename,
            'print_type' => $request->print_type,
            'total_page' => $request->total_page,
            'total_copy' => $request->total_copy,
            'paper_type' => $request->paper_type,
            'description' => $request->description,
            'jilid' => $request->jilid ? true : false,
            'status' => Order::MENUNGGU_PEMBAYARAN,
        ];
        $order = Order::create($data);
        return redirect(route('order.list'));
    }

    public function downloadFile($fileaccess)
    {
        $order = Order::where('file', $fileaccess)->first();
        if ($order->customer_id == Auth::user()->id || $order->store()->get()[0]->user_id == Auth::user()->id) {
            return Storage::download('documents/'.$fileaccess);
        }else{
            abort(404);
        }
    }
}
