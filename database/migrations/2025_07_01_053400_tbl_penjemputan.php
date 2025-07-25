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
            $table->string('nm_nasabah');
            $table->date('tgl_penjemputan');
            $table->time('waktu_penjemputan');
            $table->string('alamat');
            $table->string('berat');
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
