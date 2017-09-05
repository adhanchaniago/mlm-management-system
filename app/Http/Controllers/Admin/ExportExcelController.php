<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Excel;

use App\Produk;

class ExportExcelController extends Controller
{
    public function index(){
	    $produks = Produk::select('kode_prod','nama_prod','disk_prod','harga_katalog_prod','edisi_kat_prod')->get();
	    $fieldArray[] = ['kode_prod','nama_prod','disk_prod','harga_katalog_prod','edisi_kat_prod'];
	    foreach ($produks as $payment) {
	        $fieldArray[] = $payment->toArray();
	    }

	    Excel::create('produks', function($excel) use ($fieldArray) {

	        $excel->setTitle('Produk');
	        $excel->setCreator('Ladeva')->setCompany('Ladeva');
	        $excel->setDescription('payments file');

	        $excel->sheet('produks', function($sheet) use ($fieldArray) {
	            $sheet->fromArray($fieldArray, null, 'A1', false, false);
	        });

	    })->download('pdf');
    }

    public function backup($type=null){
    	if ($type=null) {
    		
    	}
    }
}
