<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $incrementing = false;

    public function detail(){
    	return $this->hasMany(InvoiceDetail::class,'id_inv_det','id');
    }

    public function member(){
    	return $this->belongsTo(Member::class,'member_inv_id','id');
    }

    public function memberrelation(){
     return $this->belongsTo(MemberRelation::class,'member_relation_inv_id','id');
    }

    public function pengiriman(){
    	return $this->belongsTo(Pengiriman::class,'id_inv_krm','id');
    }

    public function pembayaran(){
    	return $this->hasOne(Pembayaran::class,'id_invoice_pemb','id');
    }

    public function perusahaan(){
        return $this->belongsTo(JenisPerusahaan::class,'jenis_inv_mlm','id');
    }

    // public function group(){
        
    // }
}
