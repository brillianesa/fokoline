<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStatusOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('MENUNGGU PEMBAYARAN', 'VERIFIKASI PEMBAYARAN', 'PESANAN DIPROSES', 'PESANAN DAPAT DIAMBIL', 'PESANAN SELESAI', 'PESANAN DIBATALKAN', 'PESANAN DITOLAK')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
