<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nota Pembelian | No. : {{ $invoice->no_inv }} </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<script type="text/javascript">
  // $( document ).ready(function() {
      // window.print();
      // window.close();
  // });
  function doPrint() {
    window.print();            
    document.location.href = "{{ route('indexInvoice',['slug'=>$slug]) }}"; 
  }
</script>
<div class="wrapper">
  <div class="row hidden-print">
    <div class="col-xs-6 col-sm-8 col-md-10 col-lg-10">
      <div class="form-group">
        <a href="{{ URL::previous() }}" class="btn btn-danger btn-flat">Kembali</a>
      </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
      <div class="callout callout-info">
        <button class="btn btn-block btn-default btn-lg" onclick="doPrint()">  Cetak  </button>
      </div>  
    </div>
  </div>
  
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-building"></i> {{ $invoice->perusahaan->nama_mlm }}
          <small class="h4 pull-right">No. Nota : # <strong>{{ $invoice->no_inv }}</strong></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <i class="fa fa-dot-circle-o"></i>   Pengirim
        <hr style="margin: 5px 3px">
        <address>
          <strong class="text-uppercase">{{ $invoice->perusahaan->nama_mlm }}</strong><br>
          <strong>{{ $invoice->perusahaan->desk_mlm }}</strong>
          {{-- Jl. Haji Gedad Gg. Kijon No.14<br>
          Paninggilan Utara, Ciledug, Tangerang<br>
          Phone: (804) 123-5432<br>
          Email: bettyteguh@gmail.com --}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <i class="fa fa-dot-circle-o"></i>   Penerima
        <hr style="margin: 5px 3px">
        <address>
          <strong class="text-uppercase">{{ $invoice->memberrelation->id_member }}</strong><br>
          <strong class="text-capitalize">{{ $invoice->member->nama_member }}</strong>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <i class="fa fa-calendar"></i>   Tanggal
        <hr style="margin: 5px 3px">
        <address>
          <strong class="h4">{{ date_format(date_create("$invoice->tanggal_inv"),"d-m-Y") }}</strong>
        </address>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th class="text-center col-md-2">Kode<br>Produk</th>
              <th class="text-center col-md-3">Nama<br>Produk</th>
              <th class="text-center">Harga<br>Katalog</th>
              <th class="text-center">Harga<br>Member</th>
              <th class="text-center">Diskon</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoice->detail as $i => $detail)
            <tr>
              <td class="text-center"> {{ $i + 1 }} </td>
              <td class="text-uppercase"> {{ $detail->produk->kode_prod }} </td>
              <td class="text-capitalize"> {{ $detail->nama_prod_det }} </td>
              <td class="text-right"> {{ number_format($detail->harga_katalog_det, "0",",",".") }} </td>
              <td class="text-right"> {{ number_format($detail->harga_member_det, "0",",",".") }} </td>
              <td class="text-center"> {{ $detail->disk_prod_det }}% </td>
              <td class="text-center"> {{ $detail->jumlah_inv_det }} </td>
              <td class="text-right"> {{ number_format($detail->subtotal_inv, "0",",",".") }} </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="7" class="text-right"><strong>Total Pembelian   </strong> </td>
              <td class="text-right"><strong>{{ number_format($invoice->total_pembelian_inv, "0",",",".") }}</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    {{-- <div class="row">
      <!-- /.col -->
      <div class="col-xs-7">
      </div>
      <div class="col-xs-5">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th class="h4 strong text-right">Total Pembelian :</th>
              <td class="h4 strong text-left">{{ number_format($invoice->total_pembelian_inv, "0",",",".") }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div> --}}
    <div class="row">
      <div class="col-xs-12">
          <strong class="pull-right" style="color: red">Terimakasih telah melakukan Pembelian Produk pada Distributor Kami. Silahkan cek kembali Nota Pembelian ini.
          </strong><br>
          <strong class="pull-right" style="color: red">Nota Pembelian Ini Belum Termasuk Biaya Pengiriman
          </strong><br>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<style type="text/css">
  .table>thead>tr>th {
    vertical-align : middle;
}
</style>
</body>
</html>