<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            // $table->increments('id');
            $table->uuid('id');
            $table->primary('id');
            // $table->unsignedInteger('member_relation_id')->nullable();
            // $table->unsignedInteger('member_user_id')->nullable();
            // $table->unsignedInteger('jenis_memb_mlm')->nullable();
            // $table->string('id_member',20)->unique()->nullable();
            $table->string('nama_member',50)->nullable();
            $table->string('pin_member',12)->unique()->nullable();
            $table->char('no_ktp_member',20)->unique()->nullable();
            $table->string('alamat_member',200)->nullable();
            $table->string('kode_pos_member',7)->nullable();
            $table->char('no_hp_member',16)->nullable();
            $table->char('no_telp_member',16)->nullable();
            $table->string('email_member',50)->nullable();
            $table->enum('jenis_kelamin_member',['l','p'])->nullable();
            $table->string('tempat_lahir_member',32)->nullable();
            $table->date('tanggal_lahir_member')->nullable();
            $table->enum('agama',['islam','kristen','katholik','hindu','budha','lainnya'])->nullable();
            $table->string('nama_ibu_kandung_member',50)->nullable();
            $table->string('nama_ahli_waris_member',50)->nullable();
            $table->string('tempat_lahir_ahli_waris_member',32)->nullable();
            $table->date('tanggal_lahir_ahli_waris_member')->nullable();
            $table->string('hubungan_member',20)->nullable();
            $table->timestamps();

            // $table->foreign('member_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('jenis_memb_mlm')->references('id')->on('jenis_perusahaans')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('member_relation_id')->references('id')->on('member_relations')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
