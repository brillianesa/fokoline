<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // "MENUNGGU PEMBAYARAN","PESANAN DIPROSES", "PESANAN DAPAT DIAMBIL", "PESANAN SELESAI".
    const BARU = 'BARU';
    const MENUNGGU_PEMBAYARAN = 'MENUNGGU PEMBAYARAN';
    const PESANAN_DIPROSES = 'PESANAN DIPROSES';
    const PESANAN_DAPAT_DIAMBIL = 'PESAN DAPAT DIAMBIL';
    const PESANAN_SELESAI = 'PESAN SELESAI';

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Order::class);
    }
}
