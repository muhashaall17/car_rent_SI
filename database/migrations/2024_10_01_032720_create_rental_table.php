<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_invoice');
            $table->date('tanggal_invoice');
            $table->integer('cabang_id');
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->string('sim');
            $table->string('ktp');
            $table->string('kk');
            $table->string('email');
            $table->string('nomor_hp');
            $table->string('ktm')->nullable()->default(null);
            $table->integer('grand_total');
            $table->enum('status_rental', ['waiting','ongoing','done','due'])->default('waiting');
            $table->timestamps();

            // Correct foreign key definitions:
            // $table->foreign('cabang_id')->references('id')->on('cabang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental');
    }
};
