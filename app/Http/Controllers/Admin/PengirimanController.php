<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pengiriman;
use App\ExpedisiPengiriman;
use App\Invoice;
use App\JenisPerusahaan;

use Carbon\Carbon;

class PengirimanController extends Controller
{
    public function index(){
    	$sidebar_menus = JenisPerusahaan::all();
    	$pengirimans = Pengiriman::whereDate('created_at',Carbon::now()->addDay(-1)->toDateString())->get();
    	return view('pages.admin.pengiriman.index',compact('pengirimans','sidebar_menus'));
    }

    public function search(){

    }

    public function ajaxStatus(Request $req){
    	if ($req->ajax()) {
    		foreach ($req->id as $key => $value) {
    			$pengiriman = Pengiriman::find($value);
				$pengiriman -> status_krm = $req->status_krm;
				if($pengiriman -> save()){
					$response[] = $pengiriman->id;
				}
    		}
            return $response;
    	}
    }
}
