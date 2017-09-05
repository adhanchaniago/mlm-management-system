<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Excel;
use DB;

use App\JenisPerusahaan;

class ImportExcelController extends Controller
{
	private $id_perusahaan;

    public function index($type=null,$slug=null){
    	$sidebar_menus = JenisPerusahaan::all();
    	// dd($type . $slug);
    	return view('pages.admin.importExport.index',compact('sidebar_menus'));
    }

    public function import(Request $req){
    	// $this->id_perusahaan = $req->nama_perusahaan;
	    if(Input::hasFile('file_excel')){
			$path = Input::file('file_excel')->getRealPath();
			$data = Excel::load($path, function($reader) { 
			})->get();
			// dd($data->count());
			if(!empty($data) && $data->count() > 0){

				foreach ($data as $key => $value) {
					// dd('ss');
					//  check
					dd($value);
					$check = DB::table('produks')->where('kode_prod','=',$value->kode_prod);
					if (empty($check->get())) {
						$insert[] = [
									'kode_prod'					=> $value->kode_prod, 
									'nama_prod' 				=> $value->nama_prod,
									'disk_prod'					=> $value->disk_prod, 
									'harga_katalog_prod' 		=> $value->harga_katalog_prod,
									'harga_member_prod'			=> $value->harga_member_prod,
									'edisi_kat_prod'   			=> $value->edisi_kat_prod,
									'jenis_prod_mlm'			=> $req->perusahaan_id
								];
					} else {
						$update = 	[
									'kode_prod'					=> $value->kode_prod, 
									'nama_prod' 				=> $value->nama_prod,
									'disk_prod'					=> $value->disk_prod, 
									'harga_katalog_prod' 		=> $value->harga_katalog_prod,
									'harga_member_prod'			=> $value->harga_member_prod,
									'edisi_kat_prod'   			=> $value->edisi_kat_prod,
									'jenis_prod_mlm'			=> $req->perusahaan_id
									];
						// $check->update($update);
					}
				}
				dd($update);
				if(!empty($insert)){
					DB::table('produks')->insert($insert);
					// dd('Insert Record successfully.');
				}
				if(!empty($update)){
					DB::table('produks')->update($update);
					// dd('Insert Record successfully.');
				}
			}

		
		}
		// return back();
    }
}
