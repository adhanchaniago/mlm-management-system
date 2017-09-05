<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
	return redirect('/login');
    // return view('welcome');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

// Route::get('/home', 'HomeController@index');
Route::get('/home', function(){
	return redirect(route('indexInvoiceAll'));
});
Route::get('/print', function(){
	return view('pages.admin.invoice.print2');
});
Route::group(['prefix'=>'ajax','middleware'=>'auth'], function(){
	Route::group(['prefix'=>'add'], function(){
		Route::post('member',['uses'=>'Admin\MemberController@ajaxAddMember','as'=>'ajaxAddMember']);
		Route::post('produk',['uses'=>'Admin\ProdukController@ajaxAddProduk','as'=>'ajaxAddProduk']);
	});

	Route::group(['prefix'=>'edit'], function(){
		Route::post('perusahaan','Admin\PerusahaanController@ajaxEditPerusahaan')->name('ajaxEditPerusahaan');
		Route::post('member',['uses'=>'Admin\MemberController@ajaxEditMember','as'=>'ajaxEditMember']);
		Route::post('produk',['uses'=>'Admin\ProdukController@ajaxEditProduk','as'=>'ajaxEditProduk']);
	});

	Route::group(['prefix'=>'update'], function(){
		Route::post('perusahaan','Admin\PerusahaanController@ajaxUpdatePerusahaan')->name('ajaxUpdatePerusahaan');
		Route::post('member',['uses'=>'Admin\MemberController@ajaxUpdateMember','as'=>'ajaxUpdateMember']);
		Route::post('produk',['uses'=>'Admin\ProdukController@ajaxUpdateProduk','as'=>'ajaxUpdateProduk']);
	});

	Route::group(['prefix'=>'delete'], function(){
		Route::post('perusahaan','Admin\PerusahaanController@ajaxDeletePerusahaan')->name('ajaxDeletePerusahaan');
		Route::post('member',['uses'=>'Admin\MemberController@ajaxDeleteMember','as'=>'ajaxDeleteMember']);
		Route::post('produk',['uses'=>'Admin\ProdukController@ajaxDeleteProduk','as'=>'ajaxDeleteProduk']);
		Route::post('invoice',['uses'=>'Admin\InvoiceController@ajaxDelete','as'=>'ajaxDeleteInvoice']);
	});

	Route::group(['prefix'=>'refresh'], function(){
		Route::post('perusahaan','Admin\PerusahaanController@ajaxRefreshPerusahaan')->name('ajaxRefreshPerusahaan');
		Route::post('member',['uses'=>'Admin\MemberController@ajaxRefreshMember','as'=>'ajaxRefreshMember']);
		Route::post('produk',['uses'=>'Admin\ProdukController@ajaxRefreshProduk','as'=>'ajaxRefreshProduk']);
		Route::post('invoice',['uses'=>'Admin\InvoiceController@ajaxRefreshInvoice','as'=>'ajaxRefreshInvoice']);
	});

	Route::group(['prefix'=>'search'], function(){
		Route::group(['prefix'=>'all'], function(){
			Route::post('member','Admin\MemberController@ajaxSearchMemberAll')->name('ajaxSearchMemberAll');
			Route::post('invoice',['uses'=>'Admin\InvoiceController@ajaxSearchInvoiceAll','as'=>'ajaxSearchInvoiceAll']);
		});

		Route::post('invoice',['uses'=>'Admin\InvoiceController@ajaxSearch','as'=>'ajaxSearchInvoice']);
		Route::post('member',['uses'=>'Admin\MemberController@ajaxSearchMember','as'=>'ajaxSearchMember']);
		Route::post('produk',['uses'=>'Admin\ProdukController@ajaxSearchProduk','as'=>'ajaxSearchProduk']);

	});

	Route::group(['prefix'=>'autocomplete'], function(){
		Route::post('member',['uses'=>'Admin\MemberController@autocompleteMember','as'=>'ajaxAutocompleteMember']);
		Route::post('shippingAddress','Admin\InvoiceController@autocompleteMemberShipping')->name('ajaxAutocompleteMemberShipping');
		Route::post('produk',['uses'=>'Admin\InvoiceController@autocompleteProduk','as'=>'ajaxAutocompleteProdukInvoice']);
		Route::post('invoice/member',['uses'=>'Admin\InvoiceController@autocompleteMember','as'=>'ajaxAutocompleteMemberInvoice']);

		Route::group(['prefix'=>'all'], function(){
			Route::post('member',['uses'=>'Admin\InvoiceController@autocompleteAllMember','as'=>'ajaxAutocompleteAllMember']);	
		});
		
	});

	Route::group(['prefix'=>'show'], function(){
		Route::post('member', ['uses'=>'Admin\MemberController@ajaxShowMember'])->name('ajaxShowMember');
	});

	Route::group(['prefix'=>'123123'], function(){

	});
});

Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
	Route::get('/','Admin\PerusahaanController@index')->name('admin');
	
	Route::group(['prefix'=>'perusahaan'], function(){
		Route::get('/','Admin\PerusahaanController@index')->name('indexPerusahaan');
		Route::post('add','Admin\PerusahaanController@addPerusahaan')->name('addPerusahaan');
	});

	// IMPORT EXPORT DATA
	Route::get('importExport','Admin\ImportExcelController@index')->name('indexImportExport');
	Route::get('import/{type?}/{slug?}','Admin\ImportExcelController@index')->name('importExcel
		');
	Route::post('import','Admin\ImportExcelController@import')->name('postImportExcel');
	Route::get('export','Admin\ExportExcelController@index')->name('exportExcel');

	Route::get('member','Admin\MemberController@all')->name('indexMemberAll');
	Route::get('member/add','Admin\MemberController@add')->name('addMember');
	Route::post('member/add','Admin\MemberController@postAdd')->name('postAddMember');
	Route::get('member/edit/{id}','Admin\MemberController@edit')->name('editMember');
	Route::post('member/update','Admin\MemberController@update')->name('updateMember');
	Route::get('member/delete/{id}','Admin\MemberController@delete')->name('deleteMember');
	Route::post('member/delete','Admin\MemberController@postDelete')->name('postDeleteMember');
	

	Route::group(['prefix'=>'member/{slug}'], function(){
		Route::get('/',['uses'=>'Admin\MemberController@index','as'=>'indexMember']);
	});

	Route::group(['prefix'=>'produk/{slug}'], function(){
		Route::get('/',['uses'=>'Admin\ProdukController@index','as'=>'indexProduk']);
	});

	Route::get('invoice','Admin\InvoiceController@all')->name('indexInvoiceAll');
	Route::get('invoice/cetak_alamat','Admin\InvoiceController@shippingAddress')->name('shippingAddress');
	Route::post('invoice/cetak_alamat/view','Admin\InvoiceController@viewShippingAddress')->name('viewShippingAddress');
	Route::get('invoice/member/{member_id?}/{tanggal_inv?}','Admin\InvoiceController@showAllInvoiceMember')->name('indexShowAllInvoiceMember');

	Route::group(['prefix'=>'invoice/{slug?}'], function(){
		Route::get('/',['uses'=>'Admin\InvoiceController@index','as'=>'indexInvoice']);
		Route::get('add',['uses'=>'Admin\InvoiceController@add','as'=>'addInvoice']);
		Route::post('add',['uses'=>'Admin\InvoiceController@postAdd','as'=>'postAddInvoice']);
		Route::get('show/{id?}',['uses'=>'Admin\InvoiceController@show','as'=>'showInvoice']);
		Route::get('edit/{id?}',['uses'=>'Admin\InvoiceController@edit','as'=>'editInvoice']);
		Route::post('update/{id}',['uses'=>'Admin\InvoiceController@update','as'=>'postUpdateInvoice']);
		Route::get('print/{id}',['uses'=>'Admin\InvoiceController@print','as'=>'printInvoice']);
	});
});

Route::group(['prefix'=>'admin/pengiriman'], function(){
	Route::get('/',['uses'=>'Admin\PengirimanController@index','as'=>'indexPengiriman']);
	Route::post('ajax/status',['uses'=>'Admin\PengirimanController@ajaxStatus','as'=>'ajaxStatusPengiriman']);
});

Route::group(['prefix'=>'admin/pembayaran'], function(){
	Route::get('/',['uses'=>'Admin\PembayaranController@index','as'=>'indexPembayaran']);
	Route::get('add',['uses'=>'Admin\PembayaranController@add','as'=>'addPembayaran']);
	// Route::get('/edit',['uses'=>'Admin\PengirimanController@index','as'=>'indexPengiriman']);
	// Route::post('/ajax/status',['uses'=>'Admin\PembayaranController@ajaxStatus','as'=>'ajaxStatusPengiriman']);
});

