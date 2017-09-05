<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('id_inv_det');
            $table->unsignedInteger('id_prod_det');
            $table->string('kode_prod_det');
            $table->string('nama_prod_det',50);
            $table->tinyInteger('disk_prod_det');
            $table->integer('harga_katalog_det');
            $table->integer('harga_member_det');
            $table->tinyInteger('jumlah_inv_det')->default(1);
            $table->integer('subtotal_inv')->default(0);
            $table->timestamps();

            $table->foreign('id_inv_det')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_prod_det')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
