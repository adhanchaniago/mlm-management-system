<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('id_invoice_pemb');
            // $table->unsignedInteger('id_member_pemb');
            $table->date('tanggal_transfer_pemb')->nullable();
            $table->string('jenis_transfer_pemb')->nullable();
            $table->string('nama_bank_pemb')->nullable();
            $table->integer('total_inv_pemb')->nullable();
            $table->integer('total_trans_pemb')->nullable();
            $table->enum('status_pemb',['Belum Dibayar','Belum Lunas','Sudah Lunas'])->default('Belum Dibayar');
            $table->timestamps();

            $table->foreign('id_invoice_pemb')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('id_member_pemb')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
