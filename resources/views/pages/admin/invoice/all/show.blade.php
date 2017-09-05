@section('htmlheader_title', 'Semua Transaksi Penjualan')
@extends('layouts.admin')
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-12">
      <div class="callout callout-success" id="message_success" style="display: none">
          <h4><i class="fa fa-check-circle"></i>   Berhasil!</h4>
          <p class="h4" id="message_success_w"></p>
      </div>
      <div class="callout callout-danger" id="message_error" style="display: none">
          <h4><i class="fa fa-exclamation"></i>   Gagal!</h4>
          <p class="message_error_w"></p>
      </div>
    </div>
    <div class="col-md-8 col-md-offset-4">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>

        <div class="info-box-content">
          <div class="col-md-8">
            <span class="info-box-text">Nama Member</span>
            <span class="info-box-number">{{ $member->nama_member }}</span>
          </div>
          <div class="col-md-4">
            <span class="info-box-text">Total Pembelian</span>
            <span class="info-box-number">Rp. {{ number_format($invoices->sum('total_pembelian_inv'),'0',',','.') }}</span>
          </div>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-body">
          {{-- <hr> --}}
          @if($invoices->isEmpty())
            <table id="table_invoice" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">No. Nota</th>
                  <th class="text-center">Nama<br>MLM</th>
                  <th class="text-center">ID Member</th>
                  <th class="text-center">Nama Member</th>
                  <th class="text-center">Qty</th>
                  <th class="text-center" class="text-center">Status<br>Pembayaran</th>
                  <th class="text-center">Total<br>Pembelian</th>
                  <th class="text-center" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="result">
                <tr>  
                  <td colspan="7">
                    <h4 class="text-center">Tidak Ada Data</h4>
                  </td>
                </tr>
              </tbody>
            </table>
          @else
          <div id="loader" class="loadersmall center-block text-center" style="display: none"></div>
          <table id="table_invoice" class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th class="text-center">No. Nota</th>
                <th class="text-center">Nama<br>MLM</th>
                <th class="text-center">ID Member</th>
                <th class="text-center">Qty</th>
                <th class="text-center" class="text-center">Status<br>Pembayaran</th>
                <th class="text-center">Total<br>Pembelian</th>
                <th class="text-center" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @foreach($invoices as $invoice)
              <tr>  
                <td class="text-uppercase">{{ $invoice -> no_inv }}</td>
                <td class="text-uppercase text-center">{{ $invoice -> perusahaan -> nama_mlm }}</td>
                <td class="text-capitalize text-center">{{ $invoice -> memberrelation -> id_member }}</td>
                {{-- <td class="text-capitalize">{{ $invoice -> member -> nama_member }}</td> --}}
                <td class="text-center col-md-1">{{ $invoice -> detail -> sum('jumlah_inv_det') }}</td>
                <td class="text-center">
                  @if($invoice -> pembayaran -> status_pemb == 'Belum Dibayar')
                    <span class="label label-danger">{{ $invoice -> pembayaran -> status_pemb }}</span>
                  @elseif($invoice -> pembayaran -> status_pemb == 'Belum Lunas')
                    <span class="label label-warning">{{ $invoice -> pembayaran -> status_pemb }}</span>
                  @elseif($invoice -> pembayaran -> status_pemb == 'Sudah Lunas')
                    <span class="label label-success">{{ $invoice -> pembayaran -> status_pemb }}</span>
                  @endif
                </td>
                <td class="text-right">{{ number_format($invoice->total_pembelian_inv,'0',',','.') }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="{{ route('showInvoice', ['slug'=>$invoice->perusahaan->url_slug,'id'=>$invoice -> id]) }}" type="button" class="btn btn-flat btn-default btn-sm show"><i class="fa fa-folder-open-o"></i>  Lihat</a>
                    <a href="{{ route('editInvoice', ['slug'=>$invoice->perusahaan->url_slug,'id'=>$invoice -> id]) }}" type="button" class="btn btn-flat btn-default btn-sm edit"><i class="fa fa-edit"></i>  Edit</a>
                    <button type="button" class="btn btn-flat btn-default btn-sm delete" value="{{ $invoice -> id }}"><i class="fa fa-trash"></i>  Delete</button>
                  </div>
                </td>
              </tr>
              @endforeach
              <tr class="table-info">
                <td colspan="3"></td>
                <td class="text-right">Total Pembelian</td>
                <td class="text-right"><strong>{{ number_format($invoices->sum('total_pembelian_inv'),'0',',','.') }}</strong></td>
                <td colspan="2"></td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>

        <div class="panel-footer">
          <a href="{{ URL::previous() }}" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i>  Kembali</a>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pembayaran</h3>
        </div>
        <div class="box-body">
          {{-- <hr> --}}
        </div>

        <div class="panel-footer">
          <a href="{{ URL::previous() }}" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i>  Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="">Hapus Produk</h4>
        </div>
        <div class="modal-body" id="hapus_content">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-flat btn-primary" id="delete_confirm"><i class="fa fa-trash"></i>  Hapus</button>
        </div>
    </div>
  </div>
</div>

@endsection
@push('css')
<style type="text/css">
.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -9999;
    background-color: #000;
}

.info-box-content {
    padding: 20px 10px;
    margin-left: 90px;
}
</style>
@endpush


@push('script')

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    }
  });
  $(document).ready(function(){
    // Setting AutoNumeric (Thousand Number Separated)
    $('.number').autoNumeric("init", {
            aSep: '.',
            aDec: ',', 
            vMin: '0',
            vMax: '9999999'
            // aSign: '€ '
    });

    // Ajax Setup
    $.ajaxSetup({
     'cache' : false
    });

    // $(document).ajaxStart(function(){
    // if($("#table_invoice").fadeOut(100)){
    //   $("#loader").delay(50).fadeIn(100); 
    // };
    // });
    // $(document).ajaxComplete(function(){
    //     if ($("#loader").fadeOut(100)) {
    //     $("#table_invoice").delay(50).fadeIn(300);
    //   }
    // });

    // Setting upd_harga_prod Number Comma
    $('body').on('change keyup blur','#upd_harga_prod , #upd_disk_prod', function(){
      h_kat_prod = $('#upd_harga_prod').autoNumeric('get');
      disk_kat_prod = $('#upd_disk_prod').val();
      h_nett_prod = h_kat_prod - (h_kat_prod * disk_kat_prod / 100);
      $('#upd_harga_nett_prod').autoNumeric('set', h_nett_prod);
    });

    // Setting Table ins_harga_prod Comma
    $('body').on('change keyup blur','#ins_harga_prod , #ins_disk_prod', function(){
      h_kat_prod = $('#ins_harga_prod').autoNumeric('get');
      disk_kat_prod = $('#ins_disk_prod').val();
      h_nett_prod = h_kat_prod - (h_kat_prod * disk_kat_prod / 100);
      $('#ins_harga_nett_prod').autoNumeric('set', h_nett_prod);
    });

    // Form Validator
    $('.form-produk').validate({
          rules: {
              kode_prod: {
                  minlength: 3,
                  maxlength: 16,
                  required: true
              },
              nama_prod: {
                  minlength: 3,
                  maxlength: 100,
                  required: true
              },
              disk_prod: {
                  minlength: 1,
                  maxlength: 2,
                  required: true,
                  // regex: "^[0-9]"
              },
              harga_prod: {
                  minlength: 3,
                  maxlength: 6,
                  required: true
              },
              edisi_kat_prod: {
                  minlength: 1,
                  maxlength: 20,
                  required: false
              }
          },
          highlight: function(element) {
              $(element).closest('.form-group').addClass('has-error');
          },
          unhighlight: function(element) {
              $(element).closest('.form-group').removeClass('has-error');
          },
          errorElement: 'span',
          errorClass: 'help-block',
          errorPlacement: function(error, element) {
              if(element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
              } else {
                  error.insertAfter(element);
              }
          },
          submitHandler: function(form) { // <- pass 'form' argument in
              $(".submit").attr("disabled", true);
              form.submit(); // <- use 'form' argument here.
          }
      });

      $('.form-produk').on('keyup blur', function () {
          if ($('.form-produk').valid()) {
              $('.submit').prop('disabled', false);
          } else {
              $('.submit').prop('disabled', 'disabled');
          }
      });
  });

  
  
// });

// $('#testcallout').hide();
$(document).ready(function(){

  // Setting Global Variabel Javascript
  var field = ['id_prod','kode_prod','nama_prod','disk_prod','harga_prod','edisi_kat_prod'];

  function preventDbClick(obj){
    event.preventDefault();
    $el = $(obj);
    $el.prop('disabled', true);
    setTimeout(function(){$el.prop('disabled', false); }, 2000);
    return true;
  }

  function refresh(type,value){
    $.ajax({
      url : '{{ route('ajaxRefreshProduk',['slug'=> 'all']) }}',
      type : 'POST',
      data : {type: type,'value':value},
      success : function(response){
        if(response.length == 0){
          $result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
        } else {
          $.each(response, function(i, res){
            $result = '<tr>';
            $result += '<td class="text-uppercase">' + res.no_inv + '</td>';
            $result += '<td class="text-capitalize">' + res.id_member + '</td>';
            $result += '<td class="text-capitalize">' + res.nama_member + '</td>';
            $result += '<td class="text-center">' + res.id_member + '</td>';
            $result += '<td class="text-center">';
            if (res.status_pembayaran == "Belum") {
            $result += '<span class="label label-warning">' + res.status_pembayaran + '</span>';
            } else {
            $result += '<span class="label label-success">' + res.status_pembayaran + '</span>';  
            }
            $result += '</td>';
            $result += '<td class="text-right number">' + res.total_pembelian + '</td>';
            $result += '<td class="text-center">';                  
            $result += '<div class="btn-group">';
            $result += '<a href="{{ route('indexInvoice') }}' + '/' + res.slug + '/show/' + res.id + '" type="button" class="btn btn-flat btn-default btn-xs show"><i class="fa fa-folder-open-o"></i>  Lihat</a>';
            $result += '<a href="{{ route('indexInvoice') }}' + '/' + res.slug + '/edit/' + res.id + '" type="button" class="btn btn-flat btn-default btn-xs edit"><i class="fa fa-edit"></i>  Edit</a>';
            $result += '<button type="button" class="btn btn-flat btn-default btn-xs delete" value="1"><i class="fa fa-trash"></i>  Delete</button>';
            $result += '</div>';
            $result += '</td>';
            $result += '</div>';
            $result += '</td>';
            $result += '</tr>';
          });
        }

        $('#result').html($result);
      }

    });
  }

  $('body').on('click','.delete', function(){
    $('#delete').modal('show');
    var id = this.value;
    $('#delete_confirm').on('click', function(){
      if(preventDbClick(this)){
        $.ajax({
          url : '{{ route('ajaxDeleteInvoice', ['slug'=> 'all']) }}',
          type : 'POST',
          data : {'id': id},
        }).done(function(response){
          console.log(response);
          $('#delete').modal('hide');
            if (response['status'] = 1) {
              $('#message_success_w').html("Nota Penjualan <strong>"+ response['nama_member'] +"</strong> dengan No. <strong>"+ response['no_inv'] +"</strong>");
              $('#message_success').show().fadeIn('slow').delay(5000).fadeOut('fast');
            }
            refresh("deleteRefresh",$('#search').val());
            // location.reload();
        });
      }
    });
  });

  $('body').on('keyup','#search', function(){
    $.ajax({
      url : '{{ route('ajaxSearchInvoice', ['slug'=> 'all']) }}',
      type : 'POST',
      data : {'type':'search', 'value': this.value,'tanggal':$('#inp_show_penjualan').val()},
      success : function(response){
        if(response.length == 0){
          $result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
        } else {

          $result = "";
          $.each(response, function(i, res){
            $result = '<tr>';
            $result += '<td class="text-uppercase">' + res.no_inv + '</td>';
            $result += '<td class="text-capitalize">' + res.id_member + '</td>';
            $result += '<td class="text-capitalize">' + res.nama_member + '</td>';
            $result += '<td class="text-center">' + res.id_member + '</td>';
            $result += '<td class="text-center">';
            if (res.status_pembayaran == "Belum") {
            $result += '<span class="label label-warning">' + res.status_pembayaran + '</span>';
            } else {
            $result += '<span class="label label-success">' + res.status_pembayaran + '</span>';  
            }
            $result += '</td>';
            $result += '<td class="text-right number">' + res.total_pembelian + '</td>';
            $result += '<td class="text-center">';                  
            $result += '<div class="btn-group">';
            $result += '<a href="{{ route('indexInvoice') }}' + '/' + res.slug + '/show/' + res.id + '" type="button" class="btn btn-flat btn-default btn-xs show"><i class="fa fa-folder-open-o"></i>  Lihat</a>';
            $result += '<a href="{{ route('indexInvoice') }}' + '/' + res.slug + '/edit/' + res.id + '" type="button" class="btn btn-flat btn-default btn-xs edit"><i class="fa fa-edit"></i>  Edit</a>';
            $result += '<button type="button" class="btn btn-flat btn-default btn-xs delete" value="1"><i class="fa fa-trash"></i>  Delete</button>';
            $result += '</div>';
            $result += '</td>';
            $result += '</div>';
            $result += '</td>';
            $result += '</tr>';
          });
        }
        $('#result').html($result);
      }
    });
  });

}); //end ready
</script>
{{-- Untuk Search Penjualan --}}
<script type="text/javascript">
  $('body').on('click','#btn_show_penjualan',function(){
    $.ajax({
      url : '{{ route('ajaxSearchInvoice', 'all') }}',
      type : 'POST',
      data : {'slug':'all','type':'show_penjualan','tanggal' : $('#inp_show_penjualan').val()},
      success : function(response){
        if (response.length == 0) {
          $result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
        } else {
            $.each(response, function(i, res){
            $result = '<tr>';
            $result += '<td class="text-uppercase">' + res.no_inv + '</td>';
            $result += '<td class="text-capitalize">' + res.id_member + '</td>';
            $result += '<td class="text-capitalize">' + res.nama_member + '</td>';
            $result += '<td class="text-center">' + res.id_member + '</td>';
            $result += '<td class="text-center">';
            if (res.status_pembayaran == "Belum") {
            $result += '<span class="label label-warning">' + res.status_pembayaran + '</span>';
            } else {
            $result += '<span class="label label-success">' + res.status_pembayaran + '</span>';  
            }
            $result += '</td>';
            $result += '<td class="text-right number">' + res.total_pembelian + '</td>';
            $result += '<td class="text-center">';                  
            $result += '<div class="btn-group">';
            $result += '<a href="{{ route('indexInvoice') }}' + '/' + res.slug + '/show/' + res.id + '" type="button" class="btn btn-flat btn-default btn-xs show"><i class="fa fa-folder-open-o"></i>  Lihat</a>';
            $result += '<a href="{{ route('indexInvoice') }}' + '/' + res.slug + '/edit/' + res.id + '" type="button" class="btn btn-flat btn-default btn-xs edit"><i class="fa fa-edit"></i>  Edit</a>';
            $result += '<button type="button" class="btn btn-flat btn-default btn-xs delete" value="1"><i class="fa fa-trash"></i>  Delete</button>';
            $result += '</div>';
            $result += '</td>';
            $result += '</div>';
            $result += '</td>';
            $result += '</tr>';
            });
        }
      $('#tanggal_invoice').html($('#inp_show_penjualan').val());
      $('#result').html($result);
      }
    });
  });
</script>
@endpush