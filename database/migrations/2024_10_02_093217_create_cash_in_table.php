<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_in', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_cin');
            $table->double('nominal');
            $table->text('deskripsi');
            $table->integer('payment_id')->nullable()->default(null);
            $table->integer('cabang_id');
            $table->timestamps();

            // $table->foreign('pembayaran_id')->references('id')->on('pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_in');
    }
};
