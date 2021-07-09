<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddStatusOrderHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE order_histories MODIFY COLUMN status ENUM('MENUNGGU PEMBAYARAN', 'VERIFIKASI PEMBAYARAN', 'PESANAN DIPROSES', 'PESANAN DAPAT DIAMBIL', 'PESANAN SELESAI', 'PESANAN DIBATALKAN', 'PESANAN DITOLAK')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_histories');
    }
}
