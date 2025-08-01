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
        Schema::create('tbl_riwayat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon', 20);
            $table->text('alamat');
            $table->date('tanggal');
            $table->string('waktu');
            $table->text('catatan')->nullable();
            $table->json('jenis_sampah');
            $table->double('berat')->default(0);
            $table->bigInteger('total_pesanan')->default(0);
            $table->string('status')->default('transaksi berhasil'); // status tetap
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
        Schema::dropIfExists('tbl_riwayat');
    }
};
