<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;

class Order extends Model
{
    use HasFactory;

    // "MENUNGGU PEMBAYARAN","PESANAN DIPROSES", "PESANAN DAPAT DIAMBIL", "PESANAN SELESAI".
    const BARU = 'BARU';
    const MENUNGGU_PEMBAYARAN = 'MENUNGGU PEMBAYARAN';
    const PESANAN_DIPROSES = 'PESANAN DIPROSES';
    const PESANAN_DAPAT_DIAMBIL = 'PESAN DAPAT DIAMBIL';
    const PESANAN_SELESAI = 'PESAN SELESAI';

    protected $fillable = ['customer_id', 'store_id', 'file', 'print_type', 'total_page', 'total_copy', 'paper_type', 'description', 'jilid', 'status'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id', 'id');
    }

    public static function getDataByRole()
    {
        $user = auth()->user();
        $role = $user->role;
        $store = Store::getListStore($user);

        $order = Order::with('customer', 'store');

        if ($role == 'customer') {
            $order->where('customer_id', $user->id);
        } else if ($role == 'store') {
            $order->whereIn('store_id', $store);
        }

        return $order;
    }
}
