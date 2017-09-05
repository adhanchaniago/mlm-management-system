<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = ['id_inv_det','id_prod_det','kode_prod_det','nama_prod_det','disk_prod_det','harga_katalog_det','harga_member_det','jumlah_inv_det','subtotal_inv'];
    
    public function produk(){
    	return $this->belongsTo(Produk::class,'id_prod_det','id');
    }
	public function invoice(){
		return $this->belongsTo(Invoice::class,'id_inv_det','id');
	}
}
