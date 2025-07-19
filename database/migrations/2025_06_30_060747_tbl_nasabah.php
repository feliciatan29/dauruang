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
        Schema::create('tbl_nasabah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_nasabah');
            $table->string('nm_nasabah');
            $table->string('alamat');
            $table->string('jenis_nasabah');
            $table->string('no_telephone');
            $table->date('tgl_daftar');
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
        Schema::dropIfExists('tbl_nasabah');
    }
};
