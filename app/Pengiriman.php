<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
	protected $table = "pengirimans";

    public function invoice(){
    	return $this->hasOne(Invoice::class,'id','no_inv_krm');
    }

    public function expedisi(){
    	return $this->belongsTo(ExpedisiPengiriman::class,'jenis_expedisi_krm','id');
    }

}
