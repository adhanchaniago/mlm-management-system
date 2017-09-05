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


    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Semua Transaksi Penjualan ( <strong>{{ date_format(date_create($tanggal_sekarang), "d - m - Y") }}</strong> ) </h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-5">
              <table class="table table-striped table-hover">

                  <tr>
                    <th>Lihat Penjualan</th>
                    <td>
                        <div class="form-group">
                          <div class="input-group margin">
                                <input id="inp_show_penjualan" class="form-control text-uppercase" type="date" value="{{ $tanggal_sekarang }}">
                                  <span class="input-group-btn">
                                    <button id="btn_show_penjualan" type="button" class="btn btn-default btn-flat">Lihat</button>
                                  </span>
                            </div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Cari </th>
                    <td><input type="text" id="search" class="form-control"></td>
                  </tr>
              </table>
              {{-- <div class="pull-right col-md-4">
                <div class="form-group">
                  <div class="input-group margin">
                            <input id="search" class="form-control text-uppercase" type="text">
                              <span class="input-group-btn">
                                <button id="btn_search" type="button" class="btn btn-info btn-flat">Cari</button>
                              </span>
                        </div>
                    </div>
              </div> --}}
            </div>
            {{-- <div class="col-md-7">
              <div class="callout callout-warning">
                <h4>Informasi</h4>
                <p>Untuk mengubah <strong>Status Pembayaran</strong> buka halaman <button type="button" class="btn btn-default btn-xs"><i class="fa fa-truck"></i>  Pengiriman</button></p>
              </div>
            </div> --}}
          </div>
          <hr>
          @if($invoices->isEmpty())
            <table id="table_invoice" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  {{-- <th class="text-center">ID Member</th> --}}
                  <th class="text-center">Nama Member</th>
                  {{-- <th class="text-center">Qty</th> --}}
                  {{-- <th class="text-center" class="text-center">Status<br>Pembayaran</th> --}}
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
          <table id="table_invoice" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                {{-- <th class="text-center">No. Nota</th> --}}
                {{-- <th class="text-center">ID Member</th> --}}
                <th class="text-center">Nama Member</th>
                {{-- <th class="text-center">Qty</th> --}}
                {{-- <th class="text-center" class="text-center">Status<br>Pembayaran</th> --}}
                <th class="text-center">Total<br>Pembelian</th>
                <th class="text-center" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="result">
              @foreach($invoices as $i => $invoice)
              <tr>  
                <td class="text-capitalize text-center">{{ $i + 1 }}</td>
                {{-- <td class="text-capitalize text-center">{{ $invoice -> memberrelation -> id_member }}</td> --}}
                <td class="text-capitalize">{{ $invoice -> nama_member }}</td>
                <td class="text-capitalize text-right">{{ number_format($invoice -> total_pembelian,'0',',','.') }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="{{ route('indexShowAllInvoiceMember', ['member_id'=>$invoice->member_id,'tanggal_invoice'=>$invoice->tanggal_inv]) }}" type="button" class="btn btn-flat btn-default btn-sm show"><i class="fa fa-folder-open-o"></i>  Lihat Semua Invoice</a>
                    
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{-- {{ $invoices->links() }} --}}
          @endif
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
</style>
@endpush


@push('script')

<script type="text/javascript">
  function numberFormat(nStr) {
    nStr += '';
    var x = nStr.split(',');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
  } 

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
      url : '{{ route('ajaxSearchInvoiceAll') }}',
      type : 'POST',
      data : {'type':'search_invoice', 'value': this.value,'tanggal_inv':$('#inp_show_penjualan').val()},
      success : function(response){
        if(response.length == 0){
          $result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
        } else {

          $result = '';
            $.each(response, function(i, res){
              $result += '<tr>';
              $result += '<td class="text-center">' + (i+1) + '</td>';
              $result += '<td class="text-capitalize">' + res.nama_member + '</td>';
              $result += '<td class="text-right number">' + numberFormat(res.total_pembelian) + '</td>';
              $result += '<td class="text-center">';                  
              $result += '<div class="btn-group">';
              $result += '<a href="{{ route('indexShowAllInvoiceMember') }}' + '/' + res.member_id + '/' + res.tanggal_inv + '" type="button" class="btn btn-flat btn-default btn-sm show"><i class="fa fa-folder-open-o"></i>  Lihat Semua Invoice</a>';
              
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
      url : '{{ route('ajaxSearchInvoiceAll') }}',
      type : 'POST',
      data : {'type':'search_invoice','tanggal_inv' : $('#inp_show_penjualan').val()},
      success : function(response){
        if (response.length == 0) {
          $result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
        } else {
            $result = '';
            $.each(response, function(i, res){
              $result += '<tr>';
              $result += '<td class="text-center">' + (i+1) + '</td>';
              $result += '<td class="text-capitalize">' + res.nama_member + '</td>';
              $result += '<td class="text-right number">' + numberFormat(res.total_pembelian) + '</td>';
              $result += '<td class="text-center">';                  
              $result += '<div class="btn-group">';
              $result += '<a href="{{ route('indexShowAllInvoiceMember') }}' + '/' + res.member_id + '/' + res.tanggal_inv + '" type="button" class="btn btn-flat btn-default btn-sm show"><i class="fa fa-folder-open-o"></i>  Lihat Semua Invoice</a>';
              
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