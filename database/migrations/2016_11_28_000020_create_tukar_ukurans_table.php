<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTukarUkuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tukar_ukurans', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('id_inv_tu');
            $table->uuid('id_member_tu');
            $table->unsignedInteger('kode_produk_lama_tu');
            $table->unsignedInteger('kode_produk_baru_tu');
            $table->date('tanggal_tu');
            $table->enum('status_tu',['Sudah','Belum'])->default('Belum');
            $table->string('keterangan_tu',200)->nullable();
            $table->timestamps();

            $table->foreign('id_inv_tu')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_member_tu')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_produk_lama_tu')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_produk_baru_tu')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tukar_ukurans');
    }
}
