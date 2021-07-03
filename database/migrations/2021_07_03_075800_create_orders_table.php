<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('store_id')->constrained('stores');
            $table->text('file');
            $table->foreignId('print_type')->constrained('store_prices');
            $table->foreignId('paper_type')->constrained('store_prices');
            $table->boolean('jilid');
            $table->text('description');
            $table->enum('status', ["MENUNGGU PEMBAYARAN", "PESANAN DIPROSES", "PESANAN DAPAT DIAMBIL", "PESANAN SELESAI"]);
            $table->integer('total_page');
            $table->integer('total_copy');
            $table->integer('total_price');
            $table->text('payment_file')->nullable();
            $table->timestamps();
        });
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
