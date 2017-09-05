<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Produk;
use App\JenisPerusahaan;

use DB;

class ProdukController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function index($slug){
        $sidebar_menus = JenisPerusahaan::all();
        $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
    	$produks = $jenis_perusahaan->produk()->orderBy('kode_prod','asc')->take(20)->get();
    	return view('pages.admin.produk.index', compact('produks','slug','jenis_perusahaan','sidebar_menus'));
    }

    public function ajaxSearchProduk(Request $req){
        // $jenis_mlm = JenisPerusahaan::where('url_slug',$slug)->first()->id;
    	if ($req->ajax()) {
    		if (!empty($req->search)) {
    			$search = JenisPerusahaan::where('id',$req->id_perusahaan)->first()
                        ->produk()
                        ->where('kode_prod','LIKE','%' . $req->search . '%')
                        ->orderBy('kode_prod','asc')
                        ->take(20)
                        ->get();
    		} else {
    			$search = null;
    		}
    		return $search;
    	}
    }

    public function ajaxRefreshProduk($slug, Request $req){
        $jenis_mlm = JenisPerusahaan::where('url_slug',$slug)->first()->id;
    	if ($req->ajax()) {
    		if ($req->type == "addRefresh")  {
                $res = JenisPerusahaan::where('url_slug',$slug)->first()->produk()->where('kode_prod','LIKE','%' . $req->value . '%')->orderBy('kode_prod','asc')->take(20)->get();
                           
    		} else if ($req->type == "editRefresh")  {
                $res = JenisPerusahaan::where('url_slug',$slug)->first()->produk()->where('kode_prod','LIKE','%' . $req->value . '%')->orderBy('updated_at','desc')->take(20)->get();
    		} else if ($req->type == "deleteRefresh")  {
    			$res = JenisPerusahaan::where('url_slug',$slug)->first()->produk()->where('kode_prod','LIKE','%' . $req->value . '%')->orderBy('kode_prod','asc')->take(20)->get();
    		} else {
                $res = JenisPerusahaan::where('url_slug',$slug)->first()->produk()->where('kode_prod','LIKE','%' . $req->value . '%')->orderBy('kode_prod','asc')->take(20)->get();
    			$res = DB::table('produks')->where('jenis_prod_mlm',$jenis_mlm)->get();
    		}
    		return $res;
    	}
    }

    public function ajaxAddProduk($slug, Request $req){
    	if ($req->ajax()) {
    		$jenis_mlm = JenisPerusahaan::where('url_slug',$slug)->first()->id;
    		$produk = new Produk();
			$produk -> kode_prod = $req -> kode_prod;
			$produk -> nama_prod = $req -> nama_prod;
			$produk -> disk_prod = $req -> disk_prod;
			$produk -> harga_katalog_prod = $req -> harga_katalog_prod;
            $produk -> harga_member_prod = $req -> harga_member_prod;
			$produk -> edisi_kat_prod = $req -> edisi_kat_prod;
			$produk -> jenis_prod_mlm = $jenis_mlm;
			
			if ($produk -> save()) {
				return 1;
			} else {
				return 0;
			}
    	}
    }

    public function ajaxEditProduk(Request $req){
    	if ($req->ajax()) {
    		return Produk::find($req->id);
    	}
    }

    public function ajaxUpdateProduk(Request $req){
    	if ($req->ajax()) {
    		$produk = Produk::find($req->id);
			$produk -> kode_prod = $req -> kode_prod;
			$produk -> nama_prod = $req -> nama_prod;
			$produk -> disk_prod = $req -> disk_prod;
			$produk -> harga_katalog_prod = $req -> harga_katalog_prod;
            $produk -> harga_member_prod = $req -> harga_member_prod;
			$produk -> edisi_kat_prod = $req -> edisi_kat_prod;
			
			if ($produk -> save()) {
				return 1;
			} else {
				return 0;
			}
    	}
    }

    public function ajaxDeleteProduk(Request $req){
    	if ($req->ajax()) {
    		$produk = Produk::find($req->id);
            
    		if($produk->delete()){
    			return 1;
    		} else {
    			return 0;
    		}
    	}
    }
}
