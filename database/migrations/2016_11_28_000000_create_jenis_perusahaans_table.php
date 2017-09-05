<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_perusahaans', function (Blueprint $table) {
            $table->increments('id');
            // $table->char('kode_mlm',);
            $table->string('nama_mlm',32);
            $table->string('desk_mlm',200)->nullable();
            $table->string('nama_distributor_mlm',32)->nullable();
            $table->string('alamat_distributor_mlm',100)->nullable();
            $table->string('url_slug',32)->unique();
            $table->char('no_hp_mlm',16)->nullable();
            $table->char('no_telp_mlm',16)->nullable();
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
        Schema::dropIfExists('jenis_perusahaans');
    }
}
