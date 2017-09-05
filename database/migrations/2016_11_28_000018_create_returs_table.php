<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returs', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('id_inv_ret');
            $table->uuid('id_member_ret');
            $table->unsignedInteger('kode_produk_ret');
            $table->date('tanggal_ret');
            $table->enum('status_ret',['Sudah','Belum'])->default('Belum');
            $table->string('keterangan_ret',200)->nullable();
            $table->timestamps();

            $table->foreign('id_inv_ret')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_member_ret')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_produk_ret')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returs');
    }
}
