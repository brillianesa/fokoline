<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Store;

class Order extends Model
{
    use HasFactory;

    const MENUNGGU_PEMBAYARAN = 'MENUNGGU PEMBAYARAN';
    const VERIFIKASI_PEMBAYARAN = 'VERIFIKASI PEMBAYARAN';
    const PESANAN_DIPROSES = 'PESANAN DIPROSES';
    const PESANAN_DAPAT_DIAMBIL = 'PESANAN DAPAT DIAMBIL';
    const PESANAN_SELESAI = 'PESANAN SELESAI';
    const PESANAN_DIBATALKAN = 'PESANAN DIBATALKAN';
    const PESANAN_DITOLAK = 'PESANAN DITOLAK';

    protected $fillable = ['customer_id', 'store_id', 'file', 'print_type', 'total_page', 'total_copy', 'paper_type', 'description', 'jilid', 'status', 'total_price'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id', 'id');
    }

    public function print_type()
    {
        return $this->belongsTo(StorePrice::class, 'print_type', 'id');
    }


    public function paper_type()
    {
        return $this->belongsTo(StorePrice::class, 'paper_type', 'id');
    }

    public static function getDataByRole()
    {
        $user = auth()->user();
        $role = $user->role;
        $store = Store::getListStore($user);

        $order = Order::with('customer', 'store', 'print_type', 'paper_type');

        if ($role == 'customer') {
            $order->where('customer_id', $user->id);
        } else if ($role == 'store') {
            $order->where('status', '!=' , Order::PESANAN_DIBATALKAN);
            $order->whereIn('store_id', $store);
            $order->orwhere('customer_id', $user->id);
        }

        return $order;
    }

    public static function orderPerStatus($storeId = null)
    {

        $query = DB::table('orders')
            ->selectRaw('status, sum(total_price) as total_price , count(1) count')
            ->groupBy('status');

        if ($storeId) {
            $query->whereIn('store_id', $storeId);
        }

        return $query->get();
    }
}
