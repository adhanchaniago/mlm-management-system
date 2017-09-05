<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatalBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batal_belis', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('id_inv_bb');
            $table->uuid('id_member_bb');
            $table->unsignedInteger('kode_produk_bb');
            $table->date('tanggal_bb');
            $table->enum('status_bb',['Sudah','Belum'])->default('Belum');
            $table->string('keterangan_bb',200)->nullable();
            $table->timestamps();

            $table->foreign('id_inv_bb')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_member_bb')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_produk_bb')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batal_belis');
    }
}
