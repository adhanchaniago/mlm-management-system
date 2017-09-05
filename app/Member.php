<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	public $incrementing = false;
	
	protected $fillable = ['nama_member','email_member','no_hp_member','no_telp_member'];

    public function perusahaan(){
    	// return $this->belongsTo(JenisPerusahaan::class,'jenis_memb_mlm','id');
    	return null;
    }

    public function relation(){
    	return $this->hasMany(MemberRelation::class);
    }
}
