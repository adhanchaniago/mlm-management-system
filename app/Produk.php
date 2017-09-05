<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	protected $fillable = ['nama_prod', 'disk_prod', 'harga_prod', 'edisi_kat_prod', 'jenis_prod_mlm', 'kode_prod'];
    // protected $fillable = ['id'];
}
