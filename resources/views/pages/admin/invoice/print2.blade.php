<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nota Pembelian | No. : </title>
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
<!-- <body onload="window.print();"> -->
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-building"></i> Paloma Shopway
          <small class="h4 pull-right">No. Nota : # <strong>INV/PALOMA/2016/1214/3/075091A</strong></small>
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
          <strong>Distributor Betty Asmarawati</strong><br>
          Jl. Haji Gedad Gg. Kijon No.14<br>
          Paninggilan Utara, Ciledug, Tangerang<br>
          Phone: (804) 123-5432<br>
          Email: bettyteguh@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <i class="fa fa-dot-circle-o"></i>   Penerima
        <hr style="margin: 5px 3px">
        <address>
          <strong>John Doe</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <b>Tanggal :</b><br>
        11 December 2016

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
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
            
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <div class="row">
      <!-- /.col -->
      <div class="col-xs-6">
      </div>
      <div class="col-xs-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Total Pembelian :</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Biaya Pengiriman</th>
              <td></td>
            </tr>
            <tr>
              <th>Total Akhir:</th>
              <td>000000</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12">
          <strong style="color: red">Terimakasih telah melakukan Pembelian Produk pada Distributor Kami. Silahkan cek kembali Nota Pembelian ini.
          </strong>
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