<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_details', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('id_member_det')->unique();
            $table->uuid('id_sponsor_member_det')->nullable();
            $table->uuid('id_upline_member_det')->nullable();
            $table->string('nama_bank_member_det',20)->nullable();
            $table->string('cabang_bank_member_det',20)->nullable();
            $table->string('no_rekening_bank_member_det',20)->nullable();
            $table->string('nama_pemilik_bank_member_det',20)->nullable();
            $table->timestamps();

            $table->foreign('id_member_det')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_sponsor_member_det')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_upline_member_det')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_details');
    }
}
