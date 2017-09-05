@section('htmlheader_title', $jenis_perusahaan->nama_mlm)
@extends('layouts.admin')

@section('main-content')

<section class="invoice">
  {{-- TEST --}}
  <form action="{{ route('postAddInvoice', $slug) }}" method="POST">
  {{csrf_field()}}
  <input type="hidden" name="jenis_inv_mlm" id="jenis_inv_mlm" value="{{ $jenis_perusahaan->id }}">

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
            <input type="hidden" name="uid" id="uid" value="{{ $invoice->id_member_inv }}">
            <div class="form-group">
              <label>ID Member</label>
              <input readonly="readonly" type="text" id="id_member" name="id_member" class="form-control autocomplete_member" value="{{ $invoice->memberrelation->id_member }}"> 
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Nama Member</label>
              <input type="text" id="nama_member" name="nama_member" class="form-control" readonly="readonly" value="{{ $invoice->memberrelation->member->nama_member }}"> 
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>No. Nota</label>
              <input type="text" id="no_inv" name="no_inv" class="form-control" readonly="readonly" value="{{ $invoice->no_inv }}">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" id="tanggal_inv" name="tanggal_inv" class="form-control" readonly="readonly" value="{{ $invoice->tanggal_inv }}">
            </div>
          </div>
          {{-- <div class="col-md-2">
            <div class="form-group">
              <label>Status Pembayaran</label>
              <select name="status_transfer_inv" class="form-control">
                @if($invoice->status_transfer_inv == 'Sudah')
                  <option value="Sudah">Sudah Lunas</option> 
                @else
                  <option value="Belum" selected="selected">Belum Dibayar</option>  
                @endif
              </select>
            </div>
          </div> --}}
        </div>
      </address>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
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
          {{-- <th class="text-center">Hapus</th> --}}
        </tr>
        </thead>
        <tbody id="tb_invoice_tr">
          @foreach($invoice->detail as $i => $detail)
            <tr>
              <input type="hidden" name="invoiceDetail[{{ $i }}][id]" class="form-control text-uppercase autocomplete_produk" value="{{ $detail->id }}">
              <input id="pid_{{ $i + 1 }}" type="hidden" name="invoiceDetail[{{ $i }}][id_prod_det]" class="form-control text-uppercase autocomplete_produk" value="{{ $detail->id_prod_det }}">
              <td>{{ $i + 1 }}</td>
              <td><input id="kode_prod_{{ $i + 1 }}" type="text" name="" class="form-control text-uppercase autocomplete_produk" value="{{ $detail->produk->kode_prod }}" readonly="readonly"></td>
              <td><input id="nama_prod_{{ $i + 1 }}" type="text" name="invoiceDetail[{{ $i }}][nama_prod_det]" class="form-control text-capitalize" value="{{ $detail->produk->nama_prod }}" readonly="readonly"></td>
              <td><input id="harga_katalog_{{ $i + 1 }}" type="text" name="invoiceDetail[{{ $i }}][harga_katalog_det]" class="form-control text-right number changes" value="{{ $detail->produk->harga_katalog_prod }}" readonly="readonly"></td>
              <td><input id="harga_member_{{ $i + 1 }}" type="text" name="invoiceDetail[{{ $i }}][harga_member_det]" class="form-control text-right number changes" value="{{ $detail->produk->harga_member_prod }}" readonly="readonly"></td>
              <td><input id="disk_prod_{{ $i + 1 }}" type="text" name="invoiceDetail[{{ $i }}][disk_prod_det]" class="form-control text-center changes" value="{{ $detail->produk->disk_prod }}" readonly="readonly"></td>
              <td><input id="qty_prod_{{ $i + 1 }}" type="number" min="1" max="20" name="invoiceDetail[{{ $i }}][jumlah_inv_det]" class="form-control qty changes text-center" value="{{ $detail->jumlah_inv_det }}" readonly="readonly"></td>
              <td><input id="subtotal_prod_{{ $i + 1 }}" type="text" name="invoiceDetail[{{ $i }}][subtotal_inv]" class="form-control text-right subtotal number" readonly="readonly" value="{{ $detail->subtotal_inv }}"></td>{{-- 
              <td>
                <button type="button" class="btn btn-default btn-flat btn-sm delete_row"><i class="fa fa-trash"></i>  </button>
              </td> --}}
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <hr>
  <div class="row box-body">
    <!-- accepted payments column -->
    <div class="col-md-8">
      <p class="lead">Tambahan Keterangan:</p>
      <textarea class="form-control" rows="3" name="keterangan_inv" readonly="readonly">{{ $invoice->keterangan_inv }}</textarea>
    </div>
    <!-- /.col -->
    <div class="col-md-4">
      {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

      <div class="table-responsive">
        <table class="table">
          {{-- <tr>
            <th style="width:50%">Total Pembelian:</th>
            <td><strong><input id="total_pembelian" type="text" class="form-control number" name=""></strong></td>
          </tr> --}}
          {{-- <tr>
            <th>Biaya Pengiriman:</th>
            <td class="col-md-6"><strong><input id="biaya_kirim" type="text" class="form-control text-right number" name="" readonly="readonly"></strong></td>
          </tr> --}}
          <tr>
            <th>Total Akhir:</th>
            <td class="col-md-6"><strong><input id="total_akhir" type="text" class="form-control text-right number" name="total_pembelian_inv" value="{{ $invoice->total_pembelian_inv }}" readonly="readonly"></strong></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12 box-footer">
      {{-- <div class="btn-group pull-right"> --}}
        <a href="{{ URL::previous() }}" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i>  Kembali</a>
        
        <a href="{{ route('editInvoice',['slug'=>$slug,'id'=>$invoice->id]) }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-edit"></i> Edit</a>
        <a href="{{ route('printInvoice',['slug'=>$slug,'id'=>$invoice->id]) }}" class="btn btn-default btn-flat pull-right"><i class="fa fa-print"></i> Print</a>
      {{-- </div> --}}
    </div>
  </div>
</section>
  </form>
@endsection
@push('script')
<script type="text/javascript">
    $('.number').autoNumeric("init", {
        aSep: '.',
        aDec: ',', 
        vMin: '0',
        vMax: '99999999'
    });
</script>
@endpush