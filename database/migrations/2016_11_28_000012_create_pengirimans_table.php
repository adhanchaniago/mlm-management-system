<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jenis_expedisi_krm')->nullable();
            $table->string('no_resi_krm',32)->default('-');
            $table->uuid('id_inv_krm');
            $table->date('tanggal_krm')->nullable();
            $table->enum('status_krm',['Belum Dikirim','Dalam Proses','Sudah Terkirim'])->default('Belum Dikirim');
            $table->integer('biaya_krm')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('jenis_expedisi_krm')->references('id')->on('expedisi_pengirimans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_inv_krm')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengirimans');
    }
}
