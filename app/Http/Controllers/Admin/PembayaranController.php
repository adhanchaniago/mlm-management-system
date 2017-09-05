<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\JenisPerusahaan;


class PembayaranController extends Controller
{
    public function index(){
    	$sidebar_menus = JenisPerusahaan::all();
    	return view('pages.admin.pembayaran.index', compact('sidebar_menus'));
    }
    public function add(){
    	$sidebar_menus = JenisPerusahaan::all();
    	return view('pages.admin.pembayaran.add', compact('sidebar_menus'));
    }
}

