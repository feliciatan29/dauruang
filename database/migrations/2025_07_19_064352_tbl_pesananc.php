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
        Schema::create('tbl_pesananc', function (Blueprint $table) {
            $table->id();
            $table->string('telepon', 20);
            $table->text('alamat');
            $table->date('tanggal');
            $table->string('waktu');
            $table->string('gambar')->nullable();
            $table->text('catatan')->nullable();
            $table->json('jenis_sampah')->nullable();
            $table->string('status')->default('diproses');
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
        Schema::dropIfExists('tbl_pesananc');
    }
};