<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRelation extends Model
{
	protected $fillable = ['member_id','perusahaan_id','id_member'];

    public function member(){
    	return $this->belongsTo(Member::class,'member_id','id');
    }

    public function perusahaan(){
    	return $this->belongsTo(JenisPerusahaan::class,'perusahaan_id','id');
    }
}
