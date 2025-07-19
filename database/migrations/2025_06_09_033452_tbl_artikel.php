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
        Schema::create('tbl_artikel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_artikel');
            $table->string('nm_penulis');
            $table->string('kategori');
            $table->date('tgl_terbit');
            $table->string('isi_artikel');
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
        Schema::dropIfExists('tbl_artikel');
    }
};
