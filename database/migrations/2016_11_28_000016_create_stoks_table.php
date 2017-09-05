<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kode_mlm_stok');
            $table->unsignedInteger('kode_produk_stok');
            $table->tinyInteger('jumlah_produk_stok')->default(1);
            $table->enum('status_stok',['habis','ada'])->default('ada');
            $table->string('keterangan_stok')->nullable();
            $table->timestamps();

            $table->foreign('kode_mlm_stok')->references('id')->on('jenis_perusahaans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_produk_stok')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stoks');
    }
}
