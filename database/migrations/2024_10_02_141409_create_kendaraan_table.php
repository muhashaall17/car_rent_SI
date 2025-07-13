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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cabang_id');
            $table->enum('jenis_kendaraan', ['mobil' , 'motor']);
            $table->string('plat_nomor');
            $table->string('merk');
            $table->string('nama_kendaraan');
            $table->string('tahun_pembuatan');
            $table->string('warna');
            $table->double('harga_sewa');
            $table->string('gambar');
            $table->enum('status', ['tersedia', 'tidak_tersedia', 'maintenance']);
            $table->timestamps();

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
        Schema::dropIfExists('kendaraan');
    }
};
