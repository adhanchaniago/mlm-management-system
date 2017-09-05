@section('htmlheader_title', $jenis_perusahaan->nama_mlm)
@extends('layouts.admin')

@section('main-content')

<section class="invoice">
  {{-- TEST --}}
  <form action="{{ route('ajaxAutocompleteInvoice', $slug) }}" method="POST">
  {{csrf_field()}}
  <input type="text" name="autocomplete">
  <button type="submit">Kirim</button>
  </form>
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
    <div class="col-sm-3 invoice-col">
      Distributor
      <address>
        <strong>Betty Asmarawati</strong><br>
        Jl. Haji Gedad Gg. Kijon No.14<br>
        Paninggilan Utara, Ciledug<br>
        Tangerang<br>
        Email: bettyteguh@gmail.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-5 invoice-col">
      <address>
        <div class="form-group">
          <label>Nama Member</label>
          <input type="text" name="nama" class="form-control input-sm"> 
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="nama" class="form-control input-sm"> 
        </div>
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
            <label>No. HP</label>
            <input type="text" name="nama" class="form-control input-sm"> 
          </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label>No. Telp</label>
              <input type="text" name="nama" class="form-control input-sm"> 
            </div>
        </div>
        </div>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <div class="form-group">
        <label>No. Nota</label>
        <input type="text" name="no_inv" class="form-control input-sm" readonly="readonly" value="{{ date("his") }}">
      </div>
      <div class="form-group">
        <label>Status Pembayaran</label>
        <select name="status_transfer_inv" class="form-control">
          <option value="Belum Lunas" selected="selected">Belum Dibayar</option>  
          <option value="Sudah Lunas">Sudah Lunas</option>  
        </select>
      </div>
      <div class="form-group">
        <label>No. Resi Pengiriman</label>
        <input type="text" name="no_resi" class="form-control input-sm">
      </div>
     
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <button id="add_row" type="button" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Tambah</button>
      <table class="table table-striped table-condensed table-hover" id="tb_invoice">
        <thead>
        <tr>
          <th>No.</th>
          <th class="text-center col-md-2">Kode</th>
          <th class="text-center col-md-3">Nama</th>
          <th class="text-center">Harga<br>Katalog</th>
          <th class="text-center">Harga<br>Netto</th>
          <th class="text-center">Diskon</th>
          <th class="text-center">Qty</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center">Hapus</th>
        </tr>
        </thead>
        <tbody id="table_auto">
          <tr>
            <td>1</td>
            <td><input id="kode_1" type="text" name="kode[]" class="form-control text-uppercase autocomplete"></td>
            <td><input id="nama_1" type="text" name="nama[]" class="form-control text-capitalize"></td>
            <td><input id="harga_1" type="text" name="harga[]" class="form-control text-right number changes"></td>
            <td><input id="harganett_1" type="text" name="harganett[]" class="form-control text-right number changes" readonly="readonly"></td>
            <td><input id="disk_1" type="text" name="disk[]" class="form-control text-right changes"></td>
            <td><input id="qty_1" type="text" name="qty[]" class="form-control qty changes" value="1"></td>
            <td><input id="subtotal_1" type="text" name="subtotal[]" class="form-control subtotal number subtotal" readonly="readonly"></td>
            <td>
              <button type="button" class="btn btn-default btn-flat btn-sm delete_row"><i class="fa fa-trash"></i>  Hapus</button>
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
    <div class="col-xs-6">
      <p class="lead">Tambahan Keterangan:</p>
      <textarea class="form-control" rows="3" class="keterangan_inv"> </textarea>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

      <div class="table-responsive">
        <table class="table">
          {{-- <tr>
            <th style="width:50%">Total Pembelian:</th>
            <td><strong><input id="total_pembelian" type="text" class="form-control number" name=""></strong></td>
          </tr> --}}
          <tr>
            <th>Biaya Pengiriman:</th>
            <td><strong><input id="biaya_kirim" type="text" class="form-control number" name=""></strong></td>
          </tr>
          <tr>
            <th>Total Akhir:</th>
            <td><strong><input id="total_akhir" type="text" class="form-control number" name="total_pembelian_inv" value="$265.24"></strong></td>
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
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Print</button>
        <button type="button" class="btn btn-success btn-flat" style="margin-right: 5px;">
          <i class="fa fa-download"></i> Simpan
        </button>
      </div>
    </div>
  </div>
</section>

@endsection
@push('css')
<style type="text/css">

/* Bootstrap Modal biar muncul */
.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -9999;
    background-color: #000;
}
/* Untuk Autocomplete */
/*
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }*/
</style>
@endpush

@push('script')
{{-- <script type="text/javascript" src="{{ asset('plugins/autocomplete/jquery.autocomplete.min.js') }}"></script> --}}
<script>
  $( function() {
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( ".autocomplete" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "search.php",
          dataType: "jsonp",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        log( "Selected: " + ui.item.value + " aka " + ui.item.id );
      }
    } );
  } );
  </script>
@endpush