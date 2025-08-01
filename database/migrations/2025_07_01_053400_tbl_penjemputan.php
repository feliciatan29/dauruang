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
        Schema::create('tbl_penjemputan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->date('tanggal');
            $table->string('waktu');
            $table->string('alamat');
            $table->string('berat');
            $table->json('jenis_sampah');
            $table->string('status');
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
        Schema::dropIfExists('tbl_penjemputan');
    }
};
