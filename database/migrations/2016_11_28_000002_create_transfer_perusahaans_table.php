<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_perusahaans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_mlm_transf');
            $table->date('tanggal_transf');
            $table->tinyInteger('jumlah_transf');
            $table->string('keterangan_transf',200)->nullable();

            $table->foreign('id_mlm_transf')->references('id')->on('jenis_perusahaans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_perusahaans');
    }
}
