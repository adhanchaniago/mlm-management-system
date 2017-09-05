<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPerusahaan extends Model
{
    public function produk(){
    	return $this->hasMany(Produk::class,'jenis_prod_mlm','id');
    }
    public function memberrelation(){
    	return $this->hasMany(MemberRelation::class,'perusahaan_id','id');
    }
}
