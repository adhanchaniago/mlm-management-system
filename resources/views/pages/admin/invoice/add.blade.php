@section('htmlheader_title', $jenis_perusahaan->nama_mlm)
@extends('layouts.admin')

@section('main-content')

<section class="invoice">
  {{-- TEST --}}
  <form id="form_invoice" action="{{ route('postAddInvoice', $slug) }}" method="POST">
  {{csrf_field()}}
  <input type="hidden" name="jenis_inv_mlm" id="jenis_inv_mlm" value="{{ $jenis_perusahaan->id }}">
  <input type="hidden" name="member_inv_id" id="member_inv_id">

  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-building"></i> Nota - {{ $jenis_perusahaan->nama_mlm }}
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-12 invoice-col">
      <address>
        <div class="row">
          <div class="col-md-2">
            <input type="hidden" name="uid" id="uid">
            <div class="form-group">
              <label>ID Member</label>
              <input type="text" id="id_member" name="id_member" class="form-control autocomplete_member" pattern="[a-zA-Z0-9]+" required="required"> 
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Nama Member</label>
              <input type="text" id="nama_member" name="nama_member" class="form-control" readonly="readonly"> 
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>No. Nota</label>
              <input type="text" id="no_inv" name="no_inv" class="form-control" readonly="readonly" value="{{ $no_inv }}">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" id="tanggal_inv" name="tanggal_inv" class="form-control" readonly="readonly" value="{{ $now }}">
            </div>
          </div>
          {{-- <div class="col-md-2">
            <div class="form-group">
              <label>Status Pembayaran</label>
              <select name="status_transfer_inv" class="form-control">
                <option value="Belum" selected="selected">Belum Dibayar</option>  
                <option value="Sudah">Sudah Lunas</option>  
              </select>
            </div>
          </div> --}}
          <!-- <div class="col-xs-3">
            <div class="form-group">
              <label>No. HP</label>
              <input type="text" id="no_hp_member" name="no_hp_member" class="form-control" readonly="readonly">  
            </div>
          </div> -->
          <!-- <div class="col-md-8">
            <div class="form-group">
              <label>Alamat</label>
              <textarea type="text" id="alamat_member" name="alamat_member" class="form-control" readonly="readonly" rows="3"></textarea> 
            </div>
          </div>
      		 -->
	      	<!-- <div class="col-xs-3">
		      	<div class="form-group">
		      		<label>No. Telp</label>
		      		<input type="text" id="no_telp_member" name="no_telp_member" class="form-control" readonly="readonly">	
		      	</div>
		      </div> -->
      	</div>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-3 invoice-col">
	    
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <hr>
    <div class="row">
    <div class="col-xs-12 table-responsive">
      <button id="add_row" type="button" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Tambah</button>
      <table class="table table-striped table-condensed table-hover" id="tb_invoice">
        <thead>
        <tr>
          <th>No.</th>
          <th class="text-center col-md-2">Kode Produk</th>
          <th class="text-center col-md-3">Nama</th>
          <th class="text-center">Harga<br>Katalog</th>
          <th class="text-center">Harga<br>Member</th>
          <th class="text-center col-md-1">Diskon</th>
          <th class="text-center col-md-1">Qty</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center">Hapus</th>
        </tr>
        </thead>
        <tbody id="tb_invoice_tr">
          <tr>
            <input id="pid_1" type="hidden" name="invoiceDetail[0][id_prod_det]" class="form-control text-uppercase">
            <td>1</td>
            <td><input id="kode_prod_1" type="text" name="invoiceDetail[0][kode_prod_det]" class="form-control text-uppercase autocomplete_produk" pattern="[a-zA-Z0-9]+" required="required"></td>
            <td><input id="nama_prod_1" type="text" name="invoiceDetail[0][nama_prod_det]" class="form-control text-capitalize"></td>
            <td><input id="harga_katalog_1" type="text" name="invoiceDetail[0][harga_katalog_det]" class="form-control text-right number changes" autocomplete="off"></td>
            <td><input id="harga_member_1" type="text" name="invoiceDetail[0][harga_member_det]" class="form-control text-right number changes" readonly="readonly" autocomplete="off"></td>
            <td><input id="disk_prod_1" type="text" name="invoiceDetail[0][disk_prod_det]" class="form-control text-center changes" autocomplete="off"></td>
            <td><input id="qty_prod_1" type="text" name="invoiceDetail[0][jumlah_inv_det]" class="form-control text-center qty changes" value="1" autocomplete="off"></td>
            <td><input id="subtotal_prod_1" type="text" name="invoiceDetail[0][subtotal_inv]" class="form-control subtotal number" readonly="readonly" autocomplete="off"></td>
            <td>
              <button type="button" class="btn btn-default btn-flat btn-sm delete_row"><i class="fa fa-trash"></i>  </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <hr>

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-md-6">
      <label>Tambahan Keterangan:</label>
      <textarea class="form-control" rows="3" name="keterangan_inv"></textarea>
    </div>
    <div class="col-md-2">
    </div>
    
    <!-- /.col -->
    <div class="col-md-4">
      {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

      <div class="table-responsive">
        <table class="table">
          {{-- <tr>
            <th>Biaya Pengiriman:</th>
            <td class="col-md-6"><strong><input id="biaya_kirim" type="text" class="form-control number" name=""></strong></td>
          </tr> --}}
          <tr>
            <th>Total Akhir:</th>
            <td class="col-md-6"><strong>
              @isset($invoice->total_pembelian_inv)
              <input id="total_akhir" type="text" class="form-control number" name="total_pembelian_inv" value="{{ $invoice->total_pembelian_inv }}"></strong>
              @else
              <input id="total_akhir" type="text" class="form-control number" name="total_pembelian_inv" value="0"></strong>
              @endisset
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">                
      <div class="pull-right">
        <div class="btn-group pull-right">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan  </button>
          <button id="submit" type="submit" class="btn btn-default btn-flat" style="margin-right: 5px;">
            <i class="fa fa-print"></i> Simpan & Print
          </button>
        </div>
        {{-- <button class="btn btn-default btn-flat" type="submit">Simpan & Print</button> --}}
      </div>
    </div>
  </div>
</section>
  </form>
@endsection

@push('css')
  @include('pages.admin.invoice.partials.styles')
@endpush
@push('script')
  @include('pages.admin.invoice.partials.scripts')
@endpush
