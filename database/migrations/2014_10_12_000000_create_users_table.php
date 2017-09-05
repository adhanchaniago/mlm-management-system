<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('jenis_memb_mlm')->nullable();
            // $table->string('id_member',20)->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('nama',50);
            $table->string('email')->unique();
            // $table->char('no_hp',16)->nullable();
            // $table->char('no_telp',16)->nullable();
            // $table->string('alamat',200)->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
