<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\{
    Order, Store, StorePrice, OrderHistory
};

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::getDataByRole();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('total_price', function ($row) {
                    return 'Rp. ' . number_format($row->total_price);
                })
                ->addColumn('action', function ($row) {
                    $button = "";

                    if ($row->status == Order::MENUNGGU_PEMBAYARAN) {
                        $uploadPaymentRoute = route('order.payment', ['id' => $row->id]);

                        if ($row->customer_id == auth()->user()->id) {
                            $button = "
                                <div class='row text-center'>
                                    <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                        <i class='fa fa-eye'></i> Detail
                                    </a>
                                    <a href='". $uploadPaymentRoute ."' class='btn btn-primary btn-xs'>
                                        <i class='fa fa-upload'></i> Upload Bukti Pembayaran
                                    </a>
                                </div>
                            ";
                        }
                    }else {
                        $button = "<div class='row text-center'>
                            <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                <i class='fa fa-eye'></i> Detail
                            </a>
                        </div>";
                    }

                    return $button;
                })
                ->rawColumns(['action','detail'])
                ->make(true);
        }

        return view('admin.order.order-list');
    }

    public function createForm($storeId)
    {
        $store = Store::findOrFail($storeId);
        $jilidprice = StorePrice::where('type', 'jilid')->first();

        return view('admin.order.order-create', compact('store', 'jilidprice'));
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
            'total_price' => $request->total_price,
        ];
        $order = Order::create($data);

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });

        return redirect(route('order.list'));
    }

    public function orderDetail($id)
    {
        $order = Order::findOrFail($id);
        $orderHistory = OrderHistory::where(['order_id' => $order->id])->get();

        return view('admin.order.order-detail', compact('order', 'orderHistory'));
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

    public function uploadPaymentForm($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.payment-form', compact('order'));
    }

    public function uploadPaymentAction(Request $request, $id)
    {
        $this->validate($request, [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $file = $request->file('img');
        $imageName = time().'.'.$file->extension();

        $order = Order::findOrFail($id);
        if ($file->move(public_path('prooffiles'), $imageName)) {
            $order->payment_file = $imageName;
            $order->status = Order::VERIFIKASI_PEMBAYARAN;
        }

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });

        return redirect(route('order.list'));
    }
}
