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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rental_id');
            $table->date('tgl_bayar');
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'pending']);
            $table->double('nominal');
            $table->string('bukti_pembayaran');
            $table->timestamps();

            // $table->foreign('rental_id')->references('id')->on('rental');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
