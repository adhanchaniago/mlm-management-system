<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\JenisPerusahaan;
use App\MemberRelation;
use App\Member;

use Session;

use DB;

class MemberController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
	}

    public function all(){
        $sidebar_menus = JenisPerusahaan::all();
        // $members = Member::take(10)->get();
        $members = DB::table('members')
                    ->select('id','nama_member','alamat_member','no_hp_member','no_telp_member')
                    ->take(10)
                    ->get();
        $slug = "all";
        return view('pages.admin.member.all', compact('members','slug','sidebar_menus'));
    }

    public function index($slug){
        $sidebar_menus = JenisPerusahaan::all();
        $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
        $members = DB::table('member_relations')
                        ->where('member_relations.perusahaan_id',$jenis_perusahaan->id)
                        ->join('members','members.id','member_relations.member_id')
                        ->select('member_relations.id_member as id_member','member_relations.member_id as member_id','members.nama_member','members.email_member','members.alamat_member','members.no_hp_member','members.no_telp_member')
                        ->take(20)
                        ->get();

        // $members = MemberRelation::where('perusahaan_id',$jenis_perusahaan->id)->take(20)->get();

    	return view('pages.admin.member.index', compact('members','slug','jenis_perusahaan','sidebar_menus'));
    }

    public function add(){
        $sidebar_menus = JenisPerusahaan::all();

        return view('pages.admin.member.add',compact('sidebar_menus','jenis_perusahaan'));
    }

    public function postAdd(Request $req){
        $member = new Member();
        // $member -> jenis_memb_mlm = $jenis_mlm;
        // $member -> id_member = $req -> id_member;
        $member -> nama_member = $req -> nama_member;
        $member -> email_member = $req -> email_member;
        $member -> no_hp_member = $req -> no_hp_member;
        $member -> no_telp_member = $req -> no_telp_member;
        $member -> alamat_member = $req -> alamat_member;

        if ($member -> save()) {
            // dd($req -> member_relations);
            foreach ($req->member_relations as $key => $value) {
                $member_relations = new MemberRelation();
                $member_relations -> perusahaan_id = $value['id_perusahaan'];
                $member_relations -> member_id = $member->id;
                $member_relations -> id_member = $value['id_member'];
                $member_relations -> save();
            }
            Session::flash('message', 'Berhasil');
            Session::flash('isi_message', 'Member Dengan Nama <strong>' . $member -> nama_member . '</strong> Berhasil Ditambahkan');
            Session::flash('callout-class', 'callout-success'); 

            return redirect(route('indexMemberAll'));
        } else {
            return 0;
        }
    }

    public function edit($id){
        $sidebar_menus = JenisPerusahaan::all();
        $member = Member::find($id);

        // Autogenerate Perusahaan Member
        foreach ($sidebar_menus as $key => $value) {
            $member_relations = MemberRelation::where('member_id',$member->id)->where('perusahaan_id',$value->id)->first();

            if (is_null($member_relations)) {
                $member_relation = new MemberRelation();
                $member_relation -> member_id = $member->id;
                $member_relation -> perusahaan_id = $value->id;
                $member_relation -> id_member = "";
                $member_relation -> save();
            }
        // END. Autogenerate Perusahaan Member

        }

        return view('pages.admin.member.edit',compact('sidebar_menus','member'));
    }

    public function update(Request $req){
        $member = Member::find($req->id);

        $nama_member = $member->nama_member;
        // $member -> jenis_memb_mlm = $jenis_mlm;
        // $member -> id_member = $req -> id_member;
        $member -> nama_member = $req -> nama_member;
        $member -> email_member = $req -> email_member;
        $member -> no_hp_member = $req -> no_hp_member;
        $member -> no_telp_member = $req -> no_telp_member;
        $member -> alamat_member = $req -> alamat_member;

        if ($member -> save()) {
            foreach ($req->member_relations as $key => $value) {
                $member_relations = MemberRelation::find($value['id_member_relation']);
                $member_relations -> id_member = $value['id_member'];
                $member_relations -> save();
            }

            Session::flash('message', 'Berhasil');
            Session::flash('isi_message', 'Member Dengan Nama <strong>' . $nama_member . '</strong> Berhasil Diubah dengan Nama <strong>' . $member->nama_member . '</strong>');
            Session::flash('callout-class', 'callout-success'); 

            return redirect(route('indexMemberAll'));
        } else {
            return 0;
        }
        
    }

    public function delete($id){
        $sidebar_menus = JenisPerusahaan::all();
        $member = Member::find($id);
        return view('pages.admin.member.delete',compact('member','sidebar_menus'));
    }

    public function postDelete(Request $req){
        $member = Member::find($req->id);
        $nama_member = $member->nama_member;
        if ($member->delete()) {
            Session::flash('message', 'Berhasil');
            Session::flash('isi_message', 'Member Dengan Nama <strong>' . $nama_member . '</strong> Berhasil Dihapus');
            Session::flash('callout-class', 'callout-success'); 

            return redirect(route('indexMemberAll'));
        } else {
            return "Masih Eror, tidak bisa hapus";
        }
    }

    
    public function ajaxSearchMemberAll( Request $req){
        if ($req->ajax()) {
            if (!empty($req->search)) {
                $members = Member::where('nama_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('alamat_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('no_hp_member','LIKE', '%' . $req->search . '%')
                            ->orderBy('nama_member','asc')->take(10)->get();

            } else {
                $members = Member::take(10)->get();
            }

            return view('pages.admin.member.search_all',compact('members'));
        }
    }

    public function ajaxSearchMember(Request $req){
    	if ($req->ajax()) {
    		if (!empty($req->search)) {
                $search = DB::table('member_relations')
                            ->join('members','members.id','member_relations.member_id')
                            ->where('member_relations.perusahaan_id',$req->id_perusahaan)
                            ->where('member_relations.id_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('members.nama_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('members.alamat_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('members.no_hp_member','LIKE', '%' . $req->search . '%')
                            ->select('member_relations.id','member_relations.id_member','members.nama_member','members.alamat_member','members.no_hp_member','members.no_telp_member')
                            ->orderBy('members.nama_member','asc')
                            ->take(20)
                            ->get();
    		} else {
                $search = null;
    		}
    		return $search;
    	}
    }

    public function ajaxRefreshMember(Request $req){
        // $jenis_mlm = JenisPerusahaan::where('url_slug',$slug)->first()->id;
    	if ($req->ajax()) {
    		if ($req->type == "addRefresh")  {
                $res = JenisPerusahaan::where('url_slug',$slug)->first()->member()->where('id_member','LIKE','%' . $req->value . '%')->orderBy('created_at','desc')->take(20)->get();
                           
    		} else if ($req->type == "editRefresh")  {
                // $res = JenisPerusahaan::where('url_slug',$slug)->first()->member()
                //         ->where('id_member','LIKE', '%' . $req->search . '%')
                //         ->orWhere('nama_member','LIKE', '%' . $req->search . '%')
                //         ->orWhere('alamat_member','LIKE', '%' . $req->search . '%')
                //         ->orWhere('no_hp_member','LIKE', '%' . $req->search . '%')
                //         ->orderBy('updated_at','desc')->take(20)->get();

                $res = DB::table('members')
                        ->join('member_relations', 'member_relations.member_id', '=', 'members.id')
                        ->where('member_relations.id_member','LIKE', '%' . $req->search . '%')
                        ->orWhere('members.nama_member','LIKE', '%' . $req->search . '%')
                        ->orWhere('members.alamat_member','LIKE', '%' . $req->search . '%')
                        ->orWhere('members.no_hp_member','LIKE', '%' . $req->search . '%')
                        ->select('member_relations.id as id','member_relations.id_member as id_member','members.nama_member','members.email_member','members.no_hp_member','members.no_telp_member','members.alamat_member','members.updated_at')
                        ->orderBy('updated_at','desc')->take(20)->get();
    		} else if ($req->type == "deleteRefresh")  {
    			// $res = JenisPerusahaan::where('url_slug',$slug)->first()->member()
       //                  ->where('id_member','LIKE', '%' . $req->search . '%')
       //                  ->orWhere('nama_member','LIKE', '%' . $req->search . '%')
       //                  ->orWhere('alamat_member','LIKE', '%' . $req->search . '%')
       //                  ->orWhere('no_hp_member','LIKE', '%' . $req->search . '%')
       //                  ->orderBy('id_member','asc')->take(20)->get();
                $res = DB::table('member_relations')
                            ->join('members','members.id','member_relations.member_id')
                            ->where('member_relations.perusahaan_id',$req->id_perusahaan)
                            ->where('member_relations.id_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('members.nama_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('members.alamat_member','LIKE', '%' . $req->search . '%')
                            ->orWhere('members.no_hp_member','LIKE', '%' . $req->search . '%')
                            ->select('member_relations.id','member_relations.id_member','members.nama_member','members.alamat_member','members.no_hp_member','members.no_telp_member')
                            ->orderBy('members.nama_member','asc')
                            ->take(20)
                            ->get();
    		} else {
                $res = JenisPerusahaan::where('url_slug',$slug)->first()->member()->where('id_member','LIKE','%' . $req->value . '%')->orderBy('id_member','desc')->take(20)->get();
    			$res = DB::table('members')->where('jenis_prod_mlm',$jenis_mlm)->get();
    		}
    		return $res;
    	}
    }

    public function ajaxAddMember($slug, Request $req){
    	if ($req->ajax()) {

    		$member = new Member();
    		// $member -> jenis_memb_mlm = $jenis_mlm;
			// $member -> id_member = $req -> id_member;
			$member -> nama_member = $req -> nama_member;
			$member -> email_member = $req -> email_member;
			$member -> no_hp_member = $req -> no_hp_member;
			$member -> no_telp_member = $req -> no_telp_member;
			$member -> alamat_member = $req -> alamat_member;

			if ($member -> save()) {
                foreach ($req->id_member as $key => $value) {
                    $member_relations = new MemberRelation();
                    $member_relations -> perusahaan_id = $key + 1;
                    $member_relations -> member_id = $member->id;
                    $member_relations -> id_member = $value;
                    $member_relations -> save();
                }

				return 1;
			} else {
				return 0;
			}
    	}
    }

    public function ajaxEditMember(Request $req){
    	if ($req->ajax()) {
    		// return Member::find($req->id);
            $res = DB::table('members')
                ->join('member_relations', 'member_relations.member_id', '=', 'members.id')
                ->where('member_relations.id','=', $req->id)
                ->select('member_relations.id as member_relation_id','member_relations.id_member as id_member','members.id as member_id','members.nama_member','members.email_member','members.no_hp_member','members.no_telp_member','members.alamat_member')
                ->take(1)->get();
            $id_member = DB::table('member_relations')->where('id',$res[0]->member_relation_id)->get();
                $data['member'] = $res[0];
                $data['id_member'] = $id_member;

            return response()->json($data);
                    	}
    }

    public function ajaxUpdateMember(Request $req){
    	if ($req->ajax()) {

            $member = Member::find($req->member_id);
            $member -> nama_member = $req -> nama_member;
            $member -> email_member = $req -> email_member;
            $member -> no_hp_member = $req -> no_hp_member;
            $member -> no_telp_member = $req -> no_telp_member;
            $member -> alamat_member = $req -> alamat_member;

            if ($member -> save()) {
                    $member_relations = MemberRelation::find($req->member_relation_id);
                    $member_relations -> id_member = $req->id_member;
                    $member_relations -> save();
                return 1;
            } else {
                return 0;
            }


   //          $member_relations = MemberRelation::find($req->id);
   //          $member_relations -> id_member = $req->id_member;

   //  		$member = Member::find($member_relations->member->id);
			// $member -> nama_member = $req -> nama_member;
			// $member -> email_member = $req -> email_member;
			// $member -> no_hp_member = $req -> no_hp_member;
			// $member -> no_telp_member = $req -> no_telp_member;
			// $member -> alamat_member = $req -> alamat_member;
			
			// if ($member_relations -> save() && $member -> save()) {
			// 	return 1;
			// } else {
			// 	return 0;
			// }
    	}
    }

    public function ajaxDeleteMember(Request $req){
    	if ($req->ajax()) {
    		$member = Member::find($req->id);

    		if($member->delete()){
    			return 1;
    		} else {
    			return 0;
    		}
    	}
    }
    public function autocompleteMember(Request $req){
        // $id_slug = JenisPerusahaan::where('url_slug',$slug)->first()->id;
        $autocomplete = DB::table('members')->where(['nama_member','LIKE','%' . $req->nama_member . '%'])->orderBy('nama_member','asc')->take(10)->get();

        return $autocomplete;
    }

    public function ajaxShowMember(Request $req){
        if ($req->ajax()) {
            // return Member::find($req->id);
            $res = DB::table('members')
                ->join('member_relations', 'member_relations.member_id', '=', 'members.id')
                ->where('member_relations.id','=', $req->id)
                ->select('member_relations.id as member_relation_id','member_relations.id_member as id_member','members.id as member_id','members.nama_member','members.email_member','members.no_hp_member','members.no_telp_member','members.alamat_member')
                ->take(1)->get();
            $id_member = DB::table('member_relations')->where('id',$res[0]->member_relation_id)->get();
                $data['member'] = $res[0];
                $data['id_member'] = $id_member;

            return response()->json($data);
                        }
    }
}
