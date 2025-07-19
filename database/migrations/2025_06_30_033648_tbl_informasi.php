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
        Schema::create('tbl_informasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_informasi');
            $table->string('kategori');
            $table->date('tgl_informasi');
            $table->text('isi_informasi');
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
        Schema::dropIfExists('tbl_informasi');
    }
};
