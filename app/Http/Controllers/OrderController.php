<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

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
                ->addColumn('file', function ($row) {
                    if ($row->status == Order::MENUNGGU_PEMBAYARAN || $row->status == Order::PESANAN_DIBATALKAN) {
                        if($row->customer_id == auth()->user()->id){
                            return '<a href="'.route('order.get.file', $row->id ).'" class="btn btn-success btn-xs"> Download </a>';
                        }else if ($row->store->user_id == auth()->user()->id) {
                            # code...
                            return '';
                        }
                    }else{
                        return '<a href="'.route('order.get.file', $row->id ).'" class="btn btn-success btn-xs"> Download </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $button = "";

                    switch ($row->status) {
                        case Order::MENUNGGU_PEMBAYARAN:
                            if ($row->customer_id == auth()->user()->id) {
                                $uploadPaymentRoute = route('order.payment', ['id' => $row->id]);
                                $button = "
                                    <div class='row text-center'>
                                    <form method='post' action='".route('order.cancel', ['id' => $row->id])."'>
                                        <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                            <i class='fa fa-eye'></i> Detail
                                        </a>
                                        <a href='". $uploadPaymentRoute ."' class='btn btn-primary btn-xs'>
                                            <i class='fa fa-upload'></i> Upload Bukti
                                        </a>
                                        <input type='hidden' name='_token' value='".csrf_token()."'>
                                            <button type='submit' class='btn btn-danger btn-xs'>
                                                <i class='fa fa-times'></i> Batalkan  
                                            </button>
                                        </form>
                                    </div>
                                ";
                            }
                            break;
                        case Order::VERIFIKASI_PEMBAYARAN:
                            if ($row->store->user_id == auth()->user()->id) {
                                $paymentfile = route('order.payment.verify', ['id' => $row->id]);
                                $button = "
                                <div class='row text-center'>
                                    <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                        <i class='fa fa-eye'></i> Detail
                                    </a>
                                    <a href='". $paymentfile ."' class='btn btn-primary btn-xs'>
                                        <i class='fa fa-upload'></i> Lihat Bukti Pembayaran
                                    </a>
                                </div>
                            ";
                            }else if($row->customer_id == auth()->user()->id){
                                $button = "
                                <div class='row text-center'>
                                    <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                        <i class='fa fa-eye'></i> Detail
                                    </a>";
                            }
                            break;
                        case Order::PESANAN_DIPROSES:
                            if ($row->store->user_id == auth()->user()->id) {
                                $orderReady = route('order.ready', ['id' => $row->id]);
                                $button = "
                                <div class='row text-center'>
                                <form method='post' action='".$orderReady."'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                    <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                        <i class='fa fa-eye'></i> Detail
                                    </a>
                                    <button type='submit' class='btn btn-warning btn-xs'>
                                        <i class='fa fa-check'></i> Pesanan Dapat Diambil  
                                    </button>
                                </form>
                                </div>
                            ";
                            }else if($row->customer_id == auth()->user()->id){
                                $button = "
                                <div class='row text-center'>
                                    <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                        <i class='fa fa-eye'></i> Detail
                                    </a>";
                            }
                            break;
                        case Order::PESANAN_DAPAT_DIAMBIL:
                            if ($row->store->user_id == auth()->user()->id) {
                                $button = "
                                <div class='row text-center'>
                                    <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                        <i class='fa fa-eye'></i> Detail
                                    </a>";
                            }else if($row->customer_id == auth()->user()->id){
                                $orderDone = route('order.done', ['id' => $row->id]);
                                $button = "
                                    <div class='row text-center'>
                                        <form method='post' action='".$orderDone."'>
                                        <input type='hidden' name='_token' value='".csrf_token()."'>
                                            <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                                <i class='fa fa-eye'></i> Detail
                                            </a>
                                            <button type='submit' class='btn btn-warning btn-xs'>
                                                <i class='fa fa-check'></i> Pesanan Diambil
                                            </button>
                                        </form>
                                    </div>
                                ";
                            }
                            break;
                        case Order::PESANAN_DIBATALKAN:
                            if($row->customer_id == auth()->user()->id){
                                $button = "<div class='row text-center'>
                                        <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                            <i class='fa fa-eye'></i> Detail
                                        </a>
                                    </div>";
                            }else if ($row->store->user_id == auth()->user()->id) {
                                # code...
                                return '';
                            }
                            break;
                        default:
                            $button = "<div class='row text-center'>
                                        <a href='".route('order.detail', ['id' => $row->id])."' class='btn btn-success btn-xs'>
                                            <i class='fa fa-eye'></i> Detail
                                        </a>
                                    </div>";
                            break;
                    }

                    return $button;
                })
                ->addColumn('status', function ($row) {
                    $color = '';
                    switch ($row->status) {
                        case Order::MENUNGGU_PEMBAYARAN:
                            $color = 'red';
                            break;
                        case Order::VERIFIKASI_PEMBAYARAN:
                            $color = 'orange';
                            break;
                        case Order::PESANAN_DIPROSES:
                            $color = 'blue';
                            break;
                        case Order::PESANAN_DAPAT_DIAMBIL:
                            $color = 'maroon';
                            break;
                        case Order::PESANAN_SELESAI:
                            $color = 'green';
                            break;
                        case Order::PESANAN_DITOLAK:
                            $color = 'red';
                            break;
                    }
                    return '<span class="badge bg-'.$color.'">
                        '.$row->status.'
                </span>';
                })
                ->rawColumns(['action','detail','status','file'])
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

    public function orderReady($id)
    {
        $order = Order::findOrFail($id);
        $order->status = Order::PESANAN_DAPAT_DIAMBIL;

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });
        
        return redirect(route('order.detail', $id));
    }

    public function orderDone($id)
    {
        $order = Order::findOrFail($id);
        $order->status = Order::PESANAN_SELESAI;

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });
        
        return redirect(route('order.detail', $id));
    }

    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = Order::PESANAN_DIBATALKAN;

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });
        
        return redirect(route('order.detail', $id));
    }

    public function orderDeny($id)
    {
        $order = Order::findOrFail($id);
        $order->status = Order::PESANAN_DITOLAK;

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });
        
        return redirect(route('order.detail', $id));
    }

    public function uploadPaymentForm($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.payment-form', compact('order'));
    }

    public function paymentDetail($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.payment-detail', compact('order'));
    }

    public function paymentVerify($id)
    {
        $order = Order::findOrFail($id);
        $order->status = Order::PESANAN_DIPROSES;

        DB::transaction(function() use ($order) {
            $order->save();

            $dataHistory = [
                'status' => $order->status,
                'order_id' => $order->id
            ];

            OrderHistory::create($dataHistory);
        });
        Session::flash('download.in.the.next.request', route('order.get.file', $order->file ));
        
        return redirect(route('order.detail', $id));
        
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
