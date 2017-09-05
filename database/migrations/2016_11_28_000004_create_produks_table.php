<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jenis_prod_mlm');
            $table->string('kode_prod',20)->unique();
            $table->string('nama_prod',100);
            $table->tinyInteger('disk_prod')->nullable();
            $table->integer('harga_katalog_prod');
            $table->integer('harga_member_prod');
            $table->string('edisi_kat_prod',20)->nullable();
            $table->timestamps();
            
            $table->foreign('jenis_prod_mlm')->references('id')->on('jenis_perusahaans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
