<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\JenisPerusahaan;
use App\Member;
use App\MemberRelation;

class PerusahaanController extends Controller
{
    public function index(){
    	$sidebar_menus = JenisPerusahaan::all();
    	$perusahaans = $sidebar_menus;
    	return view('pages.admin.perusahaan.index',compact('sidebar_menus','perusahaans'));
    }

    public function addPerusahaan(Request $req){
		$perusahaan = new JenisPerusahaan();
		$perusahaan -> nama_mlm = $req -> nama_mlm;
		$perusahaan -> url_slug = $req -> url_slug;
		$perusahaan -> desk_mlm = $req -> desk_mlm;
		$perusahaan -> nama_distributor_mlm = $req -> nama_distributor_mlm;
		$perusahaan -> alamat_distributor_mlm = $req -> alamat_distributor_mlm;
		$perusahaan -> no_hp_mlm = $req -> no_hp_mlm;
		$perusahaan -> no_telp_mlm = $req -> no_telp_mlm;

		if ($perusahaan -> save()) { 
			// Menambahkan Otomatis
			$member = Member::all();
			foreach ($member as $value) {
				$member_relation = new MemberRelation();
		        $member_relation -> member_id = $value->id;
		        $member_relation -> perusahaan_id = $perusahaan->id;
		        $member_relation -> id_member = "";
		        $member_relation -> save();	
			}
			
			return redirect(route('indexPerusahaan'));
		} else {
			return 'oops';
		}
    }

    public function ajaxEditPerusahaan(Request $req){
    	if ($req->ajax()) {
    		return JenisPerusahaan::find($req->id);
    	}
    }

    public function ajaxUpdatePerusahaan(Request $req){
    	if ($req->ajax()) {
    		$perusahaan = JenisPerusahaan::find($req->id);
			$perusahaan -> nama_mlm = $req -> nama_mlm;
			$perusahaan -> desk_mlm = $req -> desk_mlm;
			$perusahaan -> nama_distributor_mlm = $req -> nama_distributor_mlm;
			$perusahaan -> alamat_distributor_mlm = $req -> alamat_distributor_mlm;
			$perusahaan -> no_hp_mlm = $req -> no_hp_mlm;
			$perusahaan -> no_telp_mlm = $req -> no_telp_mlm;
			
			if ($perusahaan -> save()) {
				return 1;
			} else {
				return 0;
			}
    	}
    }

    public function ajaxRefreshPerusahaan(Request $req){
    	if ($req->ajax()) {
    		return JenisPerusahaan::all();
    	}
    }
    public function ajaxDeletePerusahaan(Request $req){
    	if ($req->ajax()) {
    		$delete = JenisPerusahaan::find($req->id_perusahaan)->delete();
    		if ($delete) {
    			return 1;
    		} else  {
    			return 0;
    		}


    	}
    }
}
