@section('htmlheader_title', '$jenis_perusahaan->nama_mlm')
@extends('layouts.admin')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border hidden-print">
          <h3 class="box-title">Cetak Alamat</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <input type="button" value="Print 1st Div" onclick="javascript:printDiv('result')" />
          <div class="row hidden-print">
            <div class="col-md-3">
              <div class="form-group">
                <label>Pilih Ukuran</label>
                <select id="ukuran_alamat" class="form-control">
                <option value=""></option>
                  <option value="1">Kecil 2</option>
                  <option value="2">Kecil 4</option>
                  <option value="3">Kecil 8</option>
                  <option value="4">Sedang 1</option>
                  <option value="5">Sedang 2</option>
                  <option value="6">Sedang 2</option>
                  <option value="7">Sedang 2</option>
                </select>
              </div>
            </div>
            <div class="col-md-9"></div>
          </div>
        </div>
          <div class="row row">
            <div id="result">
              
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection

@push('css')
<style type="text/css">
  @media print {
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    float: left;
  }
  table, th, td {
    font-size: 11px;
  }
  .col-sm-12 {
    width: 100%;
    padding: 0px;
    margin: 0px;
  }
  .col-sm-11 {
    width: 91.66666667%;
  }
  .col-sm-10 {
    width: 83.33333333%;
  }
  .col-sm-9 {
    width: 75%;
  }
  .col-sm-8 {
    width: 66.66666667%;
  }
  .col-sm-7 {
    width: 58.33333333%;
  }
  .col-sm-6 {
    width: 50%;
    padding: 0px;
    margin: 0px;
  }
  .col-sm-5 {
    width: 41.66666667%;
  }
  .col-sm-4 {
    width: 33.33333333%;
  }
  .col-sm-3 {
    width: 25%;
  }
  .col-sm-2 {
    width: 16.66666667%;
  }
  .col-sm-1 {
    width: 8.33333333%;
  }
  .col-sm-pull-12 {
    right: 100%;
  }
  .col-sm-pull-11 {
    right: 91.66666667%;
  }
  .col-sm-pull-10 {
    right: 83.33333333%;
  }
  .col-sm-pull-9 {
    right: 75%;
  }
  .col-sm-pull-8 {
    right: 66.66666667%;
  }
  .col-sm-pull-7 {
    right: 58.33333333%;
  }
  .col-sm-pull-6 {
    right: 50%;
  }
  .col-sm-pull-5 {
    right: 41.66666667%;
  }
  .col-sm-pull-4 {
    right: 33.33333333%;
  }
  .col-sm-pull-3 {
    right: 25%;
  }
  .col-sm-pull-2 {
    right: 16.66666667%;
  }
  .col-sm-pull-1 {
    right: 8.33333333%;
  }
  .col-sm-pull-0 {
    right: auto;
  }
  .col-sm-push-12 {
    left: 100%;
  }
  .col-sm-push-11 {
    left: 91.66666667%;
  }
  .col-sm-push-10 {
    left: 83.33333333%;
  }
  .col-sm-push-9 {
    left: 75%;
  }
  .col-sm-push-8 {
    left: 66.66666667%;
  }
  .col-sm-push-7 {
    left: 58.33333333%;
  }
  .col-sm-push-6 {
    left: 50%;
  }
  .col-sm-push-5 {
    left: 41.66666667%;
  }
  .col-sm-push-4 {
    left: 33.33333333%;
  }
  .col-sm-push-3 {
    left: 25%;
  }
  .col-sm-push-2 {
    left: 16.66666667%;
  }
  .col-sm-push-1 {
    left: 8.33333333%;
  }
  .col-sm-push-0 {
    left: auto;
  }
  .col-sm-offset-12 {
    margin-left: 100%;
  }
  .col-sm-offset-11 {
    margin-left: 91.66666667%;
  }
  .col-sm-offset-10 {
    margin-left: 83.33333333%;
  }
  .col-sm-offset-9 {
    margin-left: 75%;
  }
  .col-sm-offset-8 {
    margin-left: 66.66666667%;
  }
  .col-sm-offset-7 {
    margin-left: 58.33333333%;
  }
  .col-sm-offset-6 {
    margin-left: 50%;
  }
  .col-sm-offset-5 {
    margin-left: 41.66666667%;
  }
  .col-sm-offset-4 {
    margin-left: 33.33333333%;
  }
  .col-sm-offset-3 {
    margin-left: 25%;
  }
  .col-sm-offset-2 {
    margin-left: 16.66666667%;
  }
  .col-sm-offset-1 {
    margin-left: 8.33333333%;
  }
  .col-sm-offset-0 {
    margin-left: 0%;
  }
}
</style>

<style>
.pure-table {
    /* Remove spacing between table cells (from Normalize.css) */
    border-collapse: collapse;
    border-spacing: 0;
    empty-cells: show;
    border: 1px solid #cbcbcb;
}

.pure-table caption {
    color: #000;
    font: italic 85%/1 arial, sans-serif;
    padding: 1em 0;
    text-align: center;
}

.pure-table td,
.pure-table th {
    border-left: 1px solid #cbcbcb;/*  inner column border */
    border-width: 0 0 0 1px;
    font-size: inherit;
    margin: 0;
    overflow: visible; /*to make ths where the title is really long work*/
    padding: 0.5em 1em; /* cell padding */
}

/* Consider removing this next declaration block, as it causes problems when
there's a rowspan on the first cell. Case added to the tests. issue#432 */
.pure-table td:first-child,
.pure-table th:first-child {
    border-left-width: 0;
}

.pure-table thead {
    background-color: #e0e0e0;
    color: #000;
    text-align: left;
    vertical-align: bottom;
}

/*
striping:
   even - #fff (white)
   odd  - #f2f2f2 (light gray)
*/
.pure-table td {
    background-color: transparent;
}
.pure-table-odd td {
    background-color: #f2f2f2;
}

/* nth-child selector for modern browsers */
.pure-table-striped tr:nth-child(2n-1) td {
    background-color: #f2f2f2;
}

/* BORDERED TABLES */
.pure-table-bordered td {
    border-bottom: 1px solid #cbcbcb;
}
.pure-table-bordered tbody > tr:last-child > td {
    border-bottom-width: 0;
}


/* HORIZONTAL BORDERED TABLES */

.pure-table-horizontal td,
.pure-table-horizontal th {
    border-width: 0 0 1px 0;
    border-bottom: 1px solid #cbcbcb;
}
.pure-table-horizontal tbody > tr:last-child > td {
    border-bottom-width: 0;
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
  $('body').on('focus','.autocomplete_member',function(){
    id = $(this).attr('id');
    var perusahaan_id = $('#jenis_inv_mlm').val();
    console.log(perusahaan_id);
    $(this).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url : '{{ route('ajaxAutocompleteMemberShipping') }}',
          dataType: "json",
          method: 'POST',
          data: {
             id_member : request.term,
             perusahaan_id : perusahaan_id
          },
           success: function( data ) {
             response( $.map( data, function( item ) {
              return {
                    label: item.id_member,
                    value: item.id_member,
                    data : item
              }
            }));
          }
        });
      },
      autoFocus: true,          
      minLength: 1,
      // appendTo: "#modal-fullscreen",
      select: function( event, ui ) {
        $("#uid").val(ui.item.data.id);
        // $("id_member").val(ui.item.data.id_member);
        $("#nama_member_" + id).text(ui.item.data.nama_member);
        $("#alamat_member_" + id).text(ui.item.data.alamat_member);
        $("#no_hp_member_" + id).text(ui.item.data.no_hp_member);
        $("#no_telp_member_" + id).text(ui.item.data.no_telp_member);
        $("#nama_distributor_mlm_" + id).text(ui.item.data.nama_distributor_mlm);
        $("#alamat_distributor_mlm_" + id).text(ui.item.data.alamat_distributor_mlm);
        $("#no_hp_mlm_" + id).text(ui.item.data.no_hp_mlm);
        $("#no_telp_mlm_" + id).text(ui.item.data.no_telp_mlm);
        // no_inv = $("#no_inv").val() + "/" + ui.item.data.id_member;
        // $("#no_inv").val(no_inv);
      } 
    });
  });

  function ajaxx($type,$jumlah){
    $.ajax({
      url : '{{ route('viewShippingAddress') }}',
      method: 'POST',
      data: { type : $type, jumlah : $jumlah },
       success: function( response ) {
        $('#result').html(response);
        }
    });
  }

  $('body').on('focus change','#ukuran_alamat',function(){
      var type = '';
      var jumlah = 0;

      switch($('#ukuran_alamat').val()) {
          case '1':
              type = 'kecil';
              jumlah = 2;
              ajaxx(type,jumlah);
              break;
          case '2':
              type = 'kecil';
              jumlah = 4;
              ajaxx(type,jumlah);
              break;
          case '3':
              type = 'kecil';
              jumlah = 6;
              ajaxx(type,jumlah);
              break;
          case '4':
              type = 'kecil';
              jumlah = 8;
              ajaxx(type,jumlah);
              break;
          case '5':
              type = 'sedang';
              jumlah = 1;
              ajaxx(type,jumlah);
              break;
          case '6':
              type = 'sedang';
              jumlah = 2;
              ajaxx(type,jumlah);
              break;
          case '7':
              type = 'sedang';
              jumlah = 3;
              ajaxx(type,jumlah);
              break;
          case '8':
              type = 'sedang';
              jumlah = 4;
              ajaxx(type,jumlah);
              break;
          default:
              data = null;
      }

      

      
  });
</script>

<script type="text/javascript">
  function printDiv(divID) {
        var divElements = document.getElementById(divID).innerHTML;
        var oldPage = document.body.innerHTML;

        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";

        window.print();

        document.body.innerHTML = oldPage;
    }
</script>
@endpush