<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\JenisPerusahaan;
use App\Invoice;
use App\InvoiceDetail;
use App\Member;
use App\Pengiriman;
use App\Pembayaran;
use App\ExpedisiPengiriman;
use App\MemberRelation;
use Faker;

use Carbon\Carbon;
use DB;

class InvoiceController extends Controller
{
    public function __construct(){
        $this->carbon = new Carbon();
    }

    public function all(){
        $tanggal_sekarang = $this->carbon->toDateString();
        $sidebar_menus = JenisPerusahaan::all();
        $invoices = DB::table('invoices')
                        ->join('member_relations','member_relations.id','invoices.member_relation_inv_id')
                        ->join('members','members.id','member_relations.member_id')
                        ->whereDate('invoices.tanggal_inv',$tanggal_sekarang)
                        ->select('members.nama_member','member_relations.member_id','invoices.tanggal_inv',DB::raw('sum(total_pembelian_inv) as total_pembelian'))
                        ->groupBy('members.nama_member','member_relations.member_id','invoices.tanggal_inv')
                        ->get();

           

        // $invoices = Invoice::where('tanggal_inv','2017-06-02')->get();
        
        return view('pages.admin.invoice.all.index',compact('sidebar_menus','invoices','tanggal_sekarang'));
    }

    public function shippingAddress(){
        $sidebar_menus = JenisPerusahaan::all();
        return view('pages.admin.invoice.shipping_address',compact('sidebar_menus'));
        // $address = MemberRelation::where('id_member',$req->id_member)->first();
        // dd($address);
    }

    public function viewShippingAddress(Request $req){
        $type = $req->type;
        $jumlah = $req->jumlah;
        if ($type == 'kecil') {
            return view('pages.admin.invoice.cetak_alamat_kecil',compact('type','jumlah'));    
        }
        
    }

    public function showAllInvoiceMember($member_id,$tanggal_inv){
        $invoices = Invoice::where([['member_inv_id',$member_id],['tanggal_inv',$tanggal_inv]])->get();
        $tanggal_sekarang = $this->carbon->toDateString();
        $sidebar_menus = JenisPerusahaan::all();
        $member = Member::find($member_id);
        // // $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
        // $invoices = Invoice::where('created_at',$tanggal_sekarang)->paginate(20);
        return view('pages.admin.invoice.all.show',compact('sidebar_menus','invoices','tanggal_sekarang','tanggal_inv','member'));
    }

    public function ajaxRefreshInvoice($slug, Request $req){
        $jenis_mlm = JenisPerusahaan::where('url_slug',$slug)->first()->id;
        if ($req->ajax()) {
            
            if ($req->type == "deleteRefresh")  {
                $result = DB::table('invoices')
                ->join('members','members.id','=','invoices.member_inv_id')
                ->join('member_relations','member_relations.member_id','=','members.id')
                ->join('pembayarans','pembayarans.id_invoice_pemb','=','invoices.id')
                ->where('invoices.tanggal_inv', $req->tanggal_inv)
                // ->orderBy('invoices.created_at','desc')
                ->select('invoices.id as id','no_inv','nama_member','id_member','total_pembelian_inv as total_pembelian','pembayarans.status_pemb as status_pembayaran')
                ->get();
            } elseif ($req->type == "deleteRefresh" && $req->slug == "all" )  {
                // $result = DB::table('invoices')
                // ->join('members','members.id','=','invoices.id_member_inv')
                // ->join('jenis_perusahaans','jenis_perusahaans.id','=','members.jenis_memb_mlm')
                // ->where('invoices.tanggal_inv', $req->tanggal)
                // ->orderBy('invoices.created_at','desc')
                // // ->select('invoices.id as id','no_inv','nama_member','id_member','status_transfer_inv as status_pembayaran','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                // ->select('invoices.id as id','no_inv','nama_member','id_member','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                // ->get();
                // $result = null;
            }

            return $result;
        }
    }

    public function index($slug){
        $tanggal_sekarang = $this->carbon->toDateString();
        $sidebar_menus = JenisPerusahaan::all();
        $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
        $invoices = Invoice::where('jenis_inv_mlm',$jenis_perusahaan->id)->orderBy('updated_at','desc')->take(10)->paginate();
        return view('pages.admin.invoice.index',compact('sidebar_menus','jenis_perusahaan','invoices','slug','tanggal_sekarang'));
    }

    public function show($slug, $id){
        $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
        $sidebar_menus = JenisPerusahaan::all();
        $invoice = Invoice::find($id);
        return view('pages.admin.invoice.show',compact('invoice','slug','jenis_perusahaan','sidebar_menus'));
    }

    public function edit($slug, $id){
        $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
        $sidebar_menus = JenisPerusahaan::all();
        $invoice = Invoice::find($id);
        $expedisi = ExpedisiPengiriman::all();
        return view('pages.admin.invoice.edit',compact('invoice','slug','jenis_perusahaan','sidebar_menus','expedisi'));
    }

    public function update($slug, Request $req, $id){
        $member_relation = MemberRelation::where('id_member',$req->id_member)->first();

        $invoice = Invoice::find($id);
        // $invoice -> no_inv = Carbon::now()->toTimeString();
        // $invoice -> id_member_inv = $req -> uid;
        $invoice -> member_relation_inv_id = $member_relation->id;
        $invoice -> jenis_inv_mlm = $req -> jenis_inv_mlm;
        $invoice -> tanggal_inv = $req -> tanggal_inv;
        $invoice -> total_pembelian_inv = $req -> total_pembelian_inv;
        // $invoice -> status_transfer_inv = "Belum";
        $invoice -> keterangan_inv = $req -> keterangan_inv;
        $invoice -> save();

        if (!empty($req->invoiceDetail)) {
            InvoiceDetail::where('id_inv_det',$id)->delete();
            foreach ($req->invoiceDetail as $value) {
                    $invoice->detail()->create($value);
            }
        }

        return redirect(route('editInvoice',['slug'=>$slug,'id'=>$id]));
    }

    public function add($slug){
        $jenis_perusahaan = JenisPerusahaan::where('url_slug',$slug)->first();
        $sidebar_menus = JenisPerusahaan::all();
        $expedisi = ExpedisiPengiriman::all();

        // persiapan no invoice otomatis
        $carbon = Carbon::now();
        $now = $carbon->toDateString();
        $pre_invoice = "INV/" . substr(strtoupper($slug), 0, 3)  . "/" . $carbon->format('ym') . "/" . $carbon->format('d');
        // $pre_invoice = "INV/" . strtoupper($slug) . "/" . $carbon->year . "/" . $carbon->month . $carbon->day . "/";

        $count = Invoice::where([['no_inv','LIKE','%' . $pre_invoice . '%']])->count() + 1;
        $no_inv = $pre_invoice . $count;
        return view('pages.admin.invoice.add',compact('jenis_perusahaan','sidebar_menus','slug','no_inv','now','expedisi'));
    }

    public function postAdd($slug, Request $req){
        $faker = Faker\Factory::create('id_ID');

        $member_relation = MemberRelation::where('id_member',$req->id_member)->first();
        $perusahaan_id = JenisPerusahaan::where('url_slug',$slug)->first()->id;

        $invoice = new Invoice();
        $invoice -> id = $faker->unique()->uuid;
        $invoice -> no_inv = $req -> no_inv;
        $invoice -> member_relation_inv_id = $member_relation->id;
        $invoice -> member_inv_id = $req->member_inv_id;
        $invoice -> jenis_inv_mlm = $perusahaan_id;
        $invoice -> tanggal_inv = $req -> tanggal_inv;
        $invoice -> total_pembelian_inv = $req -> total_pembelian_inv;
        // $invoice -> status_transfer_inv = "Belum";
        $invoice -> keterangan_inv = $req -> keterangan_inv;
        $invoice -> save();

        if (!empty($req->invoiceDetail)) {
            foreach ($req->invoiceDetail as $value) {
                $invoice->detail()->create($value);
            }
        }
        $pembayaran = new Pembayaran();
        $pembayaran -> id_invoice_pemb = $invoice -> id;
        // $pembayaran -> id_member_pemb = $invoice -> id_member_inv;
        $pembayaran -> total_trans_pemb = 0;
        $pembayaran -> total_inv_pemb = $invoice -> total_pembelian_inv;
        $pembayaran -> save();
        
        $pengiriman = new Pengiriman();
        $pengiriman -> jenis_expedisi_krm = 1;
        $pengiriman -> id_inv_krm = $invoice->id;
        $pengiriman -> save();

        return redirect(route('printInvoice', ['slug'=>$slug,'id'=>$invoice->id]));
        // return view('pages.admin.invoice.print', compact('invoice','slug'));

    }

    public function ajaxSearch(Request $req){
        // if ($req->ajax() && $req->slug == "all") {
        //     return null;
        // } else {
            if ($req->ajax() && $req->type == "search") {
                $result = DB::table('invoices')
                ->join('members','members.id','=','invoices.id_member_inv')
                ->join('jenis_perusahaans','jenis_perusahaans.id','=','members.jenis_memb_mlm')
                ->where('invoices.tanggal_inv', $req->tanggal)
                ->where(function ($query) use ($req){
                    $query->orWhere('invoices.no_inv','LIKE', '%' . $req->value . '%')
                          // ->orWhere('invoices.status_transfer_inv','LIKE', '%' . $req->value . '%')
                          ->orWhere('members.id_member','LIKE', '%' . $req->value . '%')
                          ->orWhere('members.nama_member','LIKE', '%' . $req->value . '%');
                })
                ->orderBy('invoices.created_at','desc')
                // ->select('invoices.id as id','no_inv','nama_member','id_member','status_transfer_inv as status_pembayaran','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->select('invoices.id as id','no_inv','nama_member','id_member','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->get();
            } elseif ($req->ajax() && $req->type == "search" && $req->slug == "all") {
                $result = DB::table('invoices')
                ->join('members','members.id','=','invoices.id_member_inv')
                ->join('jenis_perusahaans','jenis_perusahaans.id','=','members.jenis_memb_mlm')
                ->where('invoices.tanggal_inv', $req->tanggal)
                ->where(function ($query) use ($req){
                    $query->orWhere('invoices.no_inv','LIKE', '%' . $req->value . '%')
                          // ->orWhere('invoices.status_transfer_inv','LIKE', '%' . $req->value . '%')
                          ->orWhere('members.id_member','LIKE', '%' . $req->value . '%')
                          ->orWhere('members.nama_member','LIKE', '%' . $req->value . '%');
                })
                ->orderBy('invoices.created_at','desc')
                // ->select('invoices.id as id','no_inv','nama_member','id_member','status_transfer_inv as status_pembayaran','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->select('invoices.id as id','no_inv','nama_member','id_member','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->get();
            } elseif ($req->ajax() && $req->type == "show_penjualan" && $req->slug == "all") {
                $result = DB::table('invoices')
                ->join('members','members.id','=','invoices.member_inv_id')
                ->join('member_relations','member_relations.member_id','=','members.id')
                ->join('jenis_perusahaans','jenis_perusahaans.id','=','members.jenis_memb_mlm')
                ->where('invoices.tanggal_inv', $req->tanggal)
                ->orderBy('invoices.created_at','desc')
                // ->select('invoices.id as id','no_inv','nama_member','id_member','status_transfer_inv as status_pembayaran','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->select('invoices.id as id','no_inv','nama_member','id_member','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->get();
                // $result = null;
            } elseif ($req->ajax() && $req->type == "show_penjualan" ) {
                $result = DB::table('invoices')
                ->join('members','members.id','=','invoices.id_member_inv')
                ->join('jenis_perusahaans','jenis_perusahaans.id','=','members.jenis_memb_mlm')
                ->where('invoices.tanggal_inv', $req->tanggal)
                ->orderBy('invoices.created_at','desc')
                ->select('invoices.id as id','no_inv','nama_member','id_member','status_transfer_inv as status_pembayaran','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->select('invoices.id as id','no_inv','nama_member','id_member','total_pembelian_inv as total_pembelian','jenis_perusahaans.url_slug as slug')
                ->get();
            } else {
                $result = "";
            }

            return $result;
        // }
    }

    public function ajaxSearchInvoiceAll(Request $req){
        if ($req->type == "search_invoice") {
            $invoices = DB::table('invoices')
                        ->join('member_relations','member_relations.id','invoices.member_relation_inv_id')
                        ->join('members','members.id','member_relations.member_id')
                        ->where([['tanggal_inv',$req->tanggal_inv],['nama_member','LIKE','%' . $req->value . '%']])
                        ->select('members.nama_member','member_relations.member_id','invoices.tanggal_inv',DB::raw('sum(total_pembelian_inv) as total_pembelian'))
                        ->groupBy('members.nama_member','member_relations.member_id','invoices.tanggal_inv')
                        ->get();
        } elseif ($req->type == "show_invoice") {
            $invoices = DB::table('invoices')
                        ->join('member_relations','member_relations.id','invoices.member_relation_inv_id')
                        ->join('members','members.id','member_relations.member_id')
                        ->where('tanggal_inv',$req->tanggal_inv)
                        ->select('members.nama_member','member_relations.member_id','invoices.tanggal_inv',DB::raw('sum(total_pembelian_inv) as total_pembelian'))
                        ->groupBy('members.nama_member','member_relations.member_id','invoices.tanggal_inv')
                        ->get();
        } else {
            $invoices = null;
        }
        
        return $invoices;

    }

    public function autocompleteProduk(Request $req){
        $autocomplete = DB::table('produks')
                        ->where([['jenis_prod_mlm',$req->perusahaan_id],['kode_prod','LIKE', $req->kode_prod . '%']])
                        ->select('id','kode_prod','nama_prod','harga_katalog_prod','harga_member_prod','disk_prod')->orderBy('kode_prod','asc')->take(10)->get();

        return $autocomplete;
    }

    public function autocompleteMember(Request $req){
        // $perusahaan_id = JenisPerusahaan::where('url_slug',$slug)->first()->id;

        $autocomplete = DB::table('member_relations')
                            ->join('members','members.id','=','member_relations.member_id')
                            ->where([['id_member','LIKE','%' . $req->id_member . '%'],['perusahaan_id',$req->perusahaan_id]])
                            // ->where()
                            ->select('members.id as member_inv_id','member_relations.id_member as id_member','members.nama_member as nama_member','members.alamat_member as alamat_member','members.no_hp_member as no_hp_member','members.no_telp_member as no_telp_member')
                            ->take(10)
                            ->get();
        // $id_slug = JenisPerusahaan::where('url_slug',$slug)->first()->id;
        // $autocomplete = DB::table('members')->where([['jenis_memb_mlm',$id_slug],['id_member','LIKE','%' . $req->id_member . '%']])->orderBy('id_member','asc')->take(10)->get();

        return $autocomplete;
    }

    public function autocompleteMemberShipping(Request $req){
        $autocomplete = DB::table('member_relations')
                            ->join('members','members.id','=','member_relations.member_id')
                            ->join('jenis_perusahaans','jenis_perusahaans.id','=','member_relations.perusahaan_id')
                            ->where('id_member','LIKE','%' . $req->id_member . '%')
                            ->select('members.id as member_inv_id','member_relations.id_member as id_member','members.nama_member as nama_member','members.alamat_member as alamat_member','members.no_hp_member as no_hp_member','members.no_telp_member as no_telp_member','jenis_perusahaans.nama_distributor_mlm as nama_distributor_mlm','jenis_perusahaans.alamat_distributor_mlm as alamat_distributor_mlm','jenis_perusahaans.no_hp_mlm as no_hp_mlm','jenis_perusahaans.no_telp_mlm as no_telp_mlm')
                            ->take(10)
                            ->get();
        return $autocomplete;
    }

    public function autocompleteAllMember(Request $req){

        // $id_slug = JenisPerusahaan::where('url_slug',$slug)->first()->id;
        // $autocomplete = DB::table('members')->where([['jenis_memb_mlm',$id_slug],['id_member','LIKE','%' . $req->id_member . '%']])->orderBy('id_member','asc')->take(10)->get();
        $autocomplete = DB::table('member_relations')
                            ->join('members','members.id','=','member_relations.member_id')
                            ->join('jenis_perusahaans','jenis_perusahaans.id','=','member_relations.perusahaan_id')
                            ->where('id_member','LIKE','%' . $req->id_member . '%')
                            // ->select('members.id as member_inv_id','member_relations.id_member as id_member','members.nama_member as nama_member','members.alamat_member as alamat_member','members.no_hp_member as no_hp_member','members.no_telp_member as no_telp_member')
                            ->take(10)
                            ->get();
        return $autocomplete;
    }

    public function ajaxDelete(Request $req){
        
        if ($req->ajax()) {
            $invoice = Invoice::find($req->id);
            $no_inv = $invoice->no_inv;
            $nama_member = $invoice->member->nama_member;
            if($invoice->delete()){
                return ['status' => 1, 'no_inv' => $no_inv, 'nama_member' => $nama_member];
            } else {
                return ['status' => 0, 'no_inv' => $no_inv, 'nama_member' => $nama_member];
            }
        }

    }

    // Tools Controller
    public function print($slug, $id){
        $invoice = Invoice::find($id);
        // return view('pages.admin.invoice.print', compact('invoice'));
        return view('pages.admin.invoice.print', compact('invoice','slug'));
    }
}
