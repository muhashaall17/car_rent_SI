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
        Schema::create('rental_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rental_id');
            $table->integer('kendaraan_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('subtotal');
            $table->date('book_date_start');
            $table->date('book_date_end');
            $table->timestamps();

            // $table->foreign('rental_id')->references('id')->on('rental');
            // $table->foreign('kendaraan_id')->references('id')->on('kendaraan');
            // $table->foreign('driver_id')->references('id')->on('driver');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental_item');
    }
};
