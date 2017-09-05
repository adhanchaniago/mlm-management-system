<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_inv',30);
            $table->unsignedInteger('member_relation_inv_id');
            $table->uuid('member_inv_id');
            $table->unsignedInteger('jenis_inv_mlm');
            $table->date('tanggal_inv');
            $table->integer('total_pembelian_inv')->default(0);
            // $table->enum('status_transfer_inv',['Belum','Sudah']);
            $table->string('keterangan_inv')->nullable();
            $table->timestamps();

            $table->foreign('member_relation_inv_id')->references('id')->on('member_relations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('member_inv_id')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jenis_inv_mlm')->references('id')->on('jenis_perusahaans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
